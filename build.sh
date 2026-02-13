#!/bin/bash
echo "🔥 Nuclear rebuild starting..."

# Delete build folder
rm -rf build/

# Clear npm cache
npm cache clean --force

# Rebuild
npm run build

# Touch theme.json to trigger WP to reload it
touch theme.json

echo "✅ Rebuild complete. Now hard refresh browser (Ctrl+Shift+R)"