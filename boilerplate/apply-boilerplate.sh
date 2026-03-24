#!/bin/bash
# apply-boilerplate.sh
# Run from inside the theme directory: bash apply-boilerplate.sh
#
# What this does:
#   1. Deletes Tailwind build tooling files
#   2. Removes accidental root files
#   3. Removes the old client-named 404 and practitioner patterns
#   4. Copies in all cleaned boilerplate files from ./boilerplate/
#
# Run `npm install` and `npm run build` after this to rebuild without Tailwind.

set -e
THEME_DIR="$(pwd)"
BOILERPLATE_DIR="$THEME_DIR/boilerplate"

echo "→ Removing old JS and CSS files..."
rm -f src/scripts/remove-block-styles.js
rm -f src/styles/tailwind.css
rm -f src/styles/variables.css
rm -f src/styles/allset.css

echo "→ Copying in cleaned boilerplate files..."
# Build tooling
cp "$BOILERPLATE_DIR/webpack.config.js"       webpack.config.js

# Theme root
cp "$BOILERPLATE_DIR/theme.json"              theme.json
cp "$BOILERPLATE_DIR/functions.php"           functions.php

# Inc
cp "$BOILERPLATE_DIR/inc/enqueues.php"        inc/enqueues.php
cp "$BOILERPLATE_DIR/inc/setup.php"           inc/setup.php
cp "$BOILERPLATE_DIR/inc/post-types.php"      inc/post-types.php
# block-styles.php is already clean — no changes needed

# Styles
cp "$BOILERPLATE_DIR/src/styles/main.css"     src/styles/main.css
cp "$BOILERPLATE_DIR/src/styles/custom.css"   src/styles/custom.css
cp "$BOILERPLATE_DIR/src/styles/core-blocks.css" src/styles/core-blocks.css
cp "$BOILERPLATE_DIR/src/styles/editor.scss"  src/styles/editor.scss

# Scripts
cp "$BOILERPLATE_DIR/src/scripts/block-mods.js" src/scripts/block-mods.js
# main.js is already clean — no changes needed
cp "$BOILERPLATE_DIR/templates/index.html"    templates/index.html
cp "$BOILERPLATE_DIR/templates/page.html"     templates/page.html
cp "$BOILERPLATE_DIR/templates/single.html"   templates/single.html
cp "$BOILERPLATE_DIR/templates/404.html"      templates/404.html
cp "$BOILERPLATE_DIR/templates/search.html"   templates/search.html
cp "$BOILERPLATE_DIR/parts/header.html"       parts/header.html
cp "$BOILERPLATE_DIR/parts/footer.html"       parts/footer.html

echo "→ Copying cleaned patterns..."
cp "$BOILERPLATE_DIR/patterns/header.php"       patterns/header.php
cp "$BOILERPLATE_DIR/patterns/footer.php"       patterns/footer.php
cp "$BOILERPLATE_DIR/patterns/banner.php"       patterns/banner.php
cp "$BOILERPLATE_DIR/patterns/banner-home.php"  patterns/banner-home.php
cp "$BOILERPLATE_DIR/patterns/blue-dome.php"    patterns/blue-dome.php
cp "$BOILERPLATE_DIR/patterns/pink-dome.php"    patterns/pink-dome.php
cp "$BOILERPLATE_DIR/patterns/coloured-box.php" patterns/coloured-box.php
cp "$BOILERPLATE_DIR/patterns/cta-button.php"   patterns/cta-button.php
cp "$BOILERPLATE_DIR/patterns/dble-textbox.php" patterns/dble-textbox.php
cp "$BOILERPLATE_DIR/patterns/image-text.php"   patterns/image-text.php
cp "$BOILERPLATE_DIR/patterns/inner-quote.php"  patterns/inner-quote.php
cp "$BOILERPLATE_DIR/patterns/media-text.php"   patterns/media-text.php
cp "$BOILERPLATE_DIR/patterns/404-content.php"  patterns/404-content.php
cp "$BOILERPLATE_DIR/patterns/staff-member.php" patterns/staff-member.php
cp "$BOILERPLATE_DIR/patterns/staff-query.php"  patterns/staff-query.php
cp "$BOILERPLATE_DIR/patterns/job-starter.php"  patterns/job-starter.php

echo ""
echo "✓ Done. Next steps:"
echo "  1. Remove 'tailwindcss' and any @tailwindcss/* packages from package.json, then: npm install"
echo "  2. Run: npm run build"
echo "  3. Add client font to theme.json > settings.typography.fontFamilies (replace body-font placeholder)"
echo "  4. Add client colours to theme.json > settings.color.palette"
echo "  5. Update pattern category label in inc/setup.php (~line 20) to the client site name"
echo "  6. Activate theme — loads clean with zero colour/font reference errors"
echo ""
echo "  Staff CPT: registered at /staff — rename in inc/post-types.php if not needed, or delete."
echo "  Dome patterns: blue-dome + pink-dome need an SVG set as cover background in the editor."
