export const layout = "layouts/designers.njk";
export const langs = ["gl", "es"];

export const pageTexts = {
  "title": "Tipógrafos",
  "description.gl": "Listado de todos los diseñadores",
  "description.es": "Listado de todos os deseñadores",
};

export default function* ({ lang, search, paginate, pageTexts, url }) {
  const pages = search.pages("type=designer lang=" + lang, "title");

  for (
    const page of paginate(pages, {
      size: 60,
      url: (n) => n === 1 ? url : `${url}${n}/`,
    })
  ) {
    if (page.pagination.page === 1) {
      page.menu = 4;
      page.type = "designers_home";
    } else {
      page.type = "designers";
    }

    yield {
      ...pageTexts,
      ...page,
    };
  }
}
