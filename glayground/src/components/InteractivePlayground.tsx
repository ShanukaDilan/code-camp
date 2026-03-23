import { Sandpack } from "@codesandbox/sandpack-react";

export default function InteractivePlayground({ initialHtml = "" }) {
  return (
    <div style={{ marginTop: '2rem', border: '1px solid #ddd', borderRadius: '8px', overflow: 'hidden' }}>
      <Sandpack
        template="vanilla" 
        theme="dark"
        options={{
          showConsoleButton: true,
          showRefreshButton: true,
          editorHeight: 400
        }}
        files={{
          "/index.html": {
            code: initialHtml || `<!DOCTYPE html>\n<html>\n<head>\n  <title>Lesson Code</title>\n  <link rel="stylesheet" href="styles.css" />\n</head>\n<body>\n  <div id="app">Hello World!</div>\n  <script src="index.js"></script>\n</body>\n</html>`,
            active: true
          },
          "/styles.css": {
            code: `body { font-family: sans-serif; padding: 20px; }`
          },
          "/index.js": {
            code: `console.log("Playground is ready!");`
          }
        }}
      />
    </div>
  );
}
