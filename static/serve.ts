import Server from "lume/core/server.ts";
import redirects from "lume/middlewares/redirects.ts";
import routes from "./_redirects.json" assert { type: "json" };

const server = new Server({
  port: 8000,
  root: `${Deno.cwd()}/_site`,
});

server.use(redirects({
  redirects: routes,
}));
server.start();

console.log("Listening on http://localhost:8000");
