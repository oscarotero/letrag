export default function ({ search, url }) {
  const page = search.page(`url=${url}`);

  if (!page) {
    return;
  }

  if (page.data.type === "classification") {
    return classification_breadcrumb(page, search);
  }

  if (page.data.type === "glossary") {
    return glossary_breadcrumb(page, search);
  }

  if (page.data.type === "word") {
    return glossary_breadcrumb(page, search);
  }

  if (page.data.type === "font") {
    return page.data.sections_ids.map((id) => {
      const section = search.page(
        `type=classification lang=${page.data.lang} id=${id}`,
      );
      return classification_breadcrumb(section, search);
    }).join("<br>");
  }

  if (page.data.menu) {
    return `<a href="${page.data.url}"><strong>${page.data.title}</strong></a>`;
  }

  if (page.data.type === "article") {
    const home = search.page("type=articles_home");
    return `<a href="${home.data.url}"><strong>${home.data.title}</strong></a>`;
  }

  if (page.data.type === "tag" || page.data.type === "tags") {
    const home = search.page("id=tags-page-1 lang=" + page.data.lang);
    return `<a href="${home.data.url}"><strong>${home.data.title}</strong></a>`;
  }

  if (page.data.type === "designer" || page.data.type === "designers") {
    const home = search.page("id=designers-page-1 lang=" + page.data.lang);
    return `<a href="${home.data.url}"><strong>${home.data.title}</strong></a>`;
  }
}

function classification_breadcrumb(page, search) {
  const links = [];

  while (page) {
    links.unshift(` &gt; <a href="${page.data.url}">${page.data.title}</a>`);
    page = search.page(
      `type=classification lang=${page.data.lang} id=${page.data.section_id}`,
    );
  }

  const home = search.page("type=classification_home");
  links.unshift(
    `<a href="${home.data.url}"><strong>${home.data.title}</strong></a>`,
  );

  return links.join(" ");
}

function glossary_breadcrumb(page, search) {
  const links = [];

  while (page) {
    links.unshift(` &gt; <a href="${page.data.url}">${page.data.title}</a>`);
    page = search.page(
      `type=glossary lang=${page.data.lang} id=${page.data.section_id}`,
    );
  }

  const home = search.page("type=glossary_home");
  links.unshift(
    `<a href="${home.data.url}"><strong>${home.data.title}</strong></a>`,
  );

  return links.join(" ");
}
