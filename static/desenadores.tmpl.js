export const layout = "layouts/designers.njk";
export const lang = ["gl", "es"];

export const gl = {
  title: "Tipógrafos",
  description: "Listado de todos los diseñadores",
};
export const es = {
  title: "Tipógrafos",
  description: "Listado de todos os deseñadores",
};

export default function* ({ search, paginate, mergeLanguages }) {
  const pages = mergeLanguages({
    gl: runPaginate("gl"),
    es: runPaginate("es"),
  });

  yield* pages;

  function runPaginate(lang) {
    return paginate(search.pages(`type=designer lang=${lang}`, "title"), {
      size: 60,
      url: (n) =>
        n === 1 ? `/${lang}/desenadores/` : `/${lang}/desenadores/${n}/`,
      each(page) {
        if (page.pagination.page === 1) {
          page.menu = 4;
          page.type = "designers_home";
        } else {
          page.type = "designers";
        }
      },
    });
  }
}
