export const layout = "layouts/designers.njk";
export const lang = ["gl", "es"];

export const gl = {
  title: "Etiquetas",
  description: "Listado de todas as etiquetas dispoñibles",
};

export const es = {
  title: "Etiquetas",
  description: "Listado de todas las etiquetas disponibles",
};

export default function* ({ search, paginate, mergeLanguages }) {
  const pages = mergeLanguages({
    gl: runPaginate("gl"),
    es: runPaginate("es"),
  });

  yield* pages;

  function runPaginate(lang) {
    return paginate(search.pages(`type=tag lang=${lang}`, "title"), {
      size: 60,
      url: (n) => n === 1 ? `/${lang}/tags/` : `/${lang}/tags/${n}/`,
      each(page) {
        if (page.pagination.page === 1) {
          page.menu = 4;
          page.type = "tags_home";
        } else {
          page.type = "tags";
        }
      },
    });
  }
}
