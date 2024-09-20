const Ziggy = {
    url: "http://127.0.0.1:8000",
    port: 8000,
    defaults: {},
    routes: {
        home: { uri: "/", methods: ["GET", "HEAD"] },
        "storage.local": {
            uri: "storage/{path}",
            methods: ["GET", "HEAD"],
            wheres: { path: ".*" },
            parameters: ["path"],
        },
    },
};
if (typeof window !== "undefined" && typeof window.Ziggy !== "undefined") {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };
