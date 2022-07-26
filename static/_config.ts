import lume from "lume/mod.ts";
import multilanguage from "./_plugins/multilanguage.ts";

const site = lume();
site.use(multilanguage());
site.copy("styles");
site.copy("imaxes");
site.copy("img");
site.copy("favicon.ico");

export default site;
