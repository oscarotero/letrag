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

export default function* ({ search, paginate, paginateLanguages }) {
  const pages = paginateLanguages({
    gl: paginate(search.pages("type=designer lang=gl", "title"), {
      size: 60,
      url: (n) => n === 1 ? "/gl/desenadores/" : `/gl/desenadores/${n}/`,
    }),
    es: paginate(search.pages("type=tag lang=es", "title"), {
      size: 60,
      url: (n) => n === 1 ? "/es/desenadores/" : `/es/desenadores/${n}/`,
    }),
  });

  for (const page of pages) {
    if (page.pagination.page === 1) {
      page.menu = 4;
      page.type = "designers_home";
    } else {
      page.type = "designers";
    }

    yield page;
  }
}
