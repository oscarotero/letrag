export default function ({ search, url }) {
  const page = search.page(`url=${url}`);

  if (!page) {
    return;
  }

  if (page.type === "classification") {
    return classification_breadcrumb(page, search);
  }

  if (page.type === "glossary") {
    return glossary_breadcrumb(page, search);
  }

  if (page.type === "word") {
    return glossary_breadcrumb(page, search);
  }

  if (page.type === "font") {
    return page.sections_ids.map((id) => {
      const section = search.page(
        `type=classification lang=${page.lang} id=${id}`,
      );
      return classification_breadcrumb(section, search);
    }).join("<br>");
  }

  if (page.menu) {
    return `<a href="${page.url}"><strong>${page.title}</strong></a>`;
  }

  if (page.type === "article") {
    const home = search.page("type=articles_home");
    return `<a href="${home.url}"><strong>${home.title}</strong></a>`;
  }

  if (page.type === "tag" || page.type === "tags") {
    const home = search.page("id=tags-page-1 lang=" + page.lang);
    return `<a href="${home.url}"><strong>${home.title}</strong></a>`;
  }

  if (page.type === "designer" || page.type === "designers") {
    const home = search.page("id=designers-page-1 lang=" + page.lang);
    return `<a href="${home.url}"><strong>${home.title}</strong></a>`;
  }
}

function classification_breadcrumb(page, search) {
  const links = [];

  while (page) {
    links.unshift(` &gt; <a href="${page.url}">${page.title}</a>`);
    page = search.page(
      `type=classification lang=${page.lang} id=${page.section_id}`,
    );
  }

  const home = search.page("type=classification_home");
  links.unshift(
    `<a href="${home.url}"><strong>${home.title}</strong></a>`,
  );

  return links.join(" ");
}

function glossary_breadcrumb(page, search) {
  const links = [];

  while (page) {
    links.unshift(` &gt; <a href="${page.url}">${page.title}</a>`);
    page = search.page(
      `type=glossary lang=${page.lang} id=${page.section_id}`,
    );
  }

  const home = search.page("type=glossary_home");
  links.unshift(
    `<a href="${home.url}"><strong>${home.title}</strong></a>`,
  );

  return links.join(" ");
}
