export const layout = "layouts/designers.njk";
export const langs = ["gl", "es"];

export const gl = {
  title: "Tipógrafos",
  description: "Listado de todos los diseñadores",
};
export const es = {
  title: "Tipógrafos",
  description: "Listado de todos os deseñadores",
};

export default function* ({ lang, search, paginate, title, description, url }) {
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
      title,
      description,
      ...page,
    };
  }
}
