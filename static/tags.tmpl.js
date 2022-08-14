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

export default function* ({ search, paginate, paginateLanguages }) {
  const pages = paginateLanguages({
    gl: paginate(search.pages("type=tag lang=gl", "title"), {
      size: 60,
      url: (n) => n === 1 ? "/gl/tags/" : `/gl/tags/${n}/`,
    }),
    es: paginate(search.pages("type=tag lang=es", "title"), {
      size: 60,
      url: (n) => n === 1 ? "/es/tags/" : `/es/tags/${n}/`,
    }),
  });

  for (const page of pages) {
    if (page.pagination.page === 1) {
      page.menu = 4;
      page.type = "tags_home";
    } else {
      page.type = "tags";
    }

    yield page;
  }
}
