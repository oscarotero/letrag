import lume from "lume/mod.ts";
import multilanguage from "https://raw.githubusercontent.com/lumeland/experimental-plugins/main/multilanguage/mod.ts";

const site = lume({
  location: new URL("https://letrag.com"),
});
site.use(multilanguage());
site.copy("styles");
site.copy("imaxes");
site.copy("img");
site.copy("favicon.ico");

// Build redirects
site.addEventListener("afterRender", () => {
  const entries = site.pages
    .filter((page) => page.dest.ext === ".html")
    .map((page) => {
      const url = page.data.url as string;
      const matchId = url.match(/^\/(es|gl)\/([^\/]+)\/(\d+)\/$/);

      if (matchId) {
        const [, lang, entity, id] = matchId;
        const previous = `https://${lang}.letrag.com/${entity}.php?id=${id}`;
        return [previous, site.url(url, true)];
      }

      const match = url.match(/^\/(es|gl)\/([^\/]+)\/$/);

      if (match) {
        const [, lang, entity] = match;
        const previous = `https://${lang}.letrag.com/${entity}.php`;
        return [previous, site.url(url, true)];
      }

      const matchLang = url.match(/^\/(es|gl)\/$/);

      if (matchLang) {
        const [, lang] = matchLang;
        const previous = `https://${lang}.letrag.com/`;
        return [previous, site.url(url, true)];
      }
      throw new Error(`Invalid url: ${url}`);
    });

  const redirects = Object.fromEntries(entries);
  redirects["https://letrag.com/"] = "https://letrag.com/gl/";

  Deno.writeTextFile(
    "_redirects.json",
    JSON.stringify(redirects, null, 2) + "\n",
  );
});

export default site;
