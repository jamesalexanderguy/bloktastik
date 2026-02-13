/**
 * Automatically imports and registers all blocks from src/blocks/
 */

// Use webpack's require.context to auto-import all block index.js files
const importAll = (r) => r.keys().forEach(r);

// Import all blocks - matches any folder with an index.js
importAll(require.context('./blocks', true, /index\.js$/));
