export const layout = "layouts/designers.njk";

export const es = {
  title: "Tipógrafos",
  description: "Listado de todos los diseñadores",
};
export const gl = {
  title: "Tipógrafos",
  description: "Listado de todos os deseñadores",
};

export default function* ({ search, paginate }) {
  const langs = ["gl", "es"];

  for (const lang of langs) {
    yield * paginate(search.pages(`type=designer lang=${lang}`, "title"), {
      size: 60,
      url: (n) =>
        n === 1 ? `/${lang}/desenadores/` : `/${lang}/desenadores/${n}/`,
      each(page, number) {
        page.lang = lang;
        page.id = `designers-page-${number}`;

        if (number === 1) {
          page.menu = 4;
        }
      },
    });
  }
}
