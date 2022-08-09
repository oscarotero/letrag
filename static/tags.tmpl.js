export const layout = "layouts/designers.njk";
export const langs = ["gl", "es"];

export const gl = {
  title: "Etiquetas",
  description: "Listado de todas as etiquetas dispoñibles",
};
export const es = {
  title: "Etiquetas",
  description: "Listado de todas las etiquetas disponibles",
};

export default function* ({ lang, search, paginate, title, description, url }) {
  const pages = search.pages("type=tag lang=" + lang, "title");

  for (
    const page of paginate(pages, {
      size: 60,
      url: (n) => n === 1 ? url : `${url}${n}/`,
    })
  ) {
    if (page.pagination.page === 1) {
      page.menu = 4;
      page.type = "tags_home";
    } else {
      page.type = "tags";
    }

    yield {
      title,
      description,
      ...page,
    };
  }
}
