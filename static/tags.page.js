export const layout = "layouts/designers.njk";

export const gl = {
  title: "Etiquetas",
  description: "Listado de todas as etiquetas dispoñibles",
};

export const es = {
  title: "Etiquetas",
  description: "Listado de todas las etiquetas disponibles",
};

export default function* ({ search, paginate }) {
  const langs = ["gl", "es"];

  for (const lang of langs) {
    yield* paginate(search.pages(`type=tag lang=${lang}`, "title"), {
      size: 60,
      url: (n) => n === 1 ? `/${lang}/tags/` : `/${lang}/tags/${n}/`,
      each(page, number) {
        page.lang = lang;
        page.id = `tags-page-${number}`;

        if (number === 1) {
          page.menu = 4;
        }
      },
    });
  }
}
