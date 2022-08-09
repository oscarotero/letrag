import Server from "lume/core/server.ts";
import redirect from "lume/middlewares/redirect.ts";
import routes from "./_redirects.json" assert { type: "json" };

const server = new Server({
  port: 8000,
  root: `${Deno.cwd()}/_site`,
});

server.use(redirect({
  redirects: routes
}))
server.start();


console.log("Listening on http://localhost:8000");