import { Page } from "lume/core/filesystem.ts";
import { isPlainObject } from "lume/core/utils.ts";

import type { Data, Plugin } from "lume/core.ts";

export default function multilanguage(): Plugin {
  return (site) => {
    site.preprocess("*", (page, pages) => {
      const { lang } = page.data;

      if (Array.isArray(lang)) {
        const languageData: Record<string, Data> = {};
        lang.forEach((key) => {
          languageData[key] = filterLanguage(lang, key, { ...page.data });
        });

        const alternates: Record<string, Page> = {};

        // Create new pages
        const newPages: Page[] = [];

        for (const [l, data] of Object.entries(languageData)) {
          data.alternates = alternates;
          data.lang = l;

          const newPage = page.duplicate(l);
          newPage.data = data;
          newPage.updateDest({
            path: `/${l}${newPage.dest.path}`,
          });
          alternates[l] = newPage;
          newPages.push(newPage);
        }

        // Replace the current page with the multiple languages
        pages.splice(pages.indexOf(page), 1, ...newPages);
      }
    });
  };
}

function filterLanguage(langs: string[], lang: string, data: Data): Data {
  for (let [name, value] of Object.entries(data)) {
    if (isPlainObject(value)) {
      data[name] = value = filterLanguage(langs, lang, {
        ...value as Record<string, unknown>,
      });
    } else if (Array.isArray(value)) {
      data[name] = value = value.map((item) => {
        return isPlainObject(item)
          ? filterLanguage(langs, lang, { ...item as Record<string, unknown> })
          : item;
      });
    }

    const parts = name.match(/^(.*)\.([^.]+)$/);

    if (parts) {
      const [, key, l] = parts;

      if (langs.includes(l)) {
        if (lang === l) {
          data[key] = value;
        }

        delete data[name];
      }
    }
  }

  return data;
}
