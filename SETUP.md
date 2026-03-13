# BabyBloom child theme setup

## Recommended structure

```text
babybloom-storefront-child/
├── assets/
│   ├── images/
│   │   ├── category-placeholder.svg
│   │   └── hero-placeholder.svg
│   └── js/
│       └── theme.js
├── inc/
│   └── customizer.php
├── template-parts/
│   └── home/
│       ├── announcement.php
│       ├── categories.php
│       ├── cta.php
│       ├── features.php
│       ├── hero.php
│       └── trust.php
├── footer.php
├── front-page.php
├── functions.php
├── header.php
├── README.md
├── SETUP.md
└── style.css
```

## WordPress admin steps

1. Install `Storefront` and activate it once so the parent theme assets are available.
2. Upload the `babybloom-storefront-child` folder into `wp-content/themes/`.
3. Activate `BabyBloom Storefront Child` in `Appearance > Themes`.
4. Install and activate WooCommerce.
5. Create or confirm these pages: Home, Shop, Sale, About, Contact, My Account, Cart.
6. Go to `Settings > Reading` and set `Home` as the static homepage.
7. Go to `Appearance > Menus` and create:
   - `Primary Menu`: Home, Shop, Sale, About, Contact
   - `Footer Menu`: Shop, My Account, Shipping, Returns, Privacy Policy, Contact
8. Assign the menus to the `Primary Menu` and `Footer Menu` locations.
9. Open `Appearance > Customize > BabyBloom Homepage` and update:
   - announcement text
   - hero heading, text, buttons, and hero image
   - CTA heading, text, and button
   - footer email, phone, and address
10. In `Appearance > Customize > Site Identity`, upload the BabyBloom logo and add a short tagline.
11. In WooCommerce, create product categories with these slugs if you want the homepage cards to auto-link:
   - `baby-clothing`
   - `toys-games`
   - `accessories`
12. Add category thumbnail images in `Products > Categories` so the homepage cards stop using placeholders.

## Hostinger deployment

1. In Hostinger hPanel, open `Files > File Manager`.
2. Navigate to `public_html/wp-content/themes/`.
3. Upload the entire `babybloom-storefront-child` folder as a zip or folder.
4. If you upload a zip, extract it in the `themes` directory.
5. Make sure the parent theme `storefront` is also installed in `wp-content/themes/`.
6. In WordPress admin, activate the child theme and repeat the admin setup steps above.
7. After activation, clear any Hostinger cache, LiteSpeed cache, or plugin cache before reviewing the homepage.

## Git + SSH deployment

If you want to stop replacing files manually in File Manager:

1. Configure SSH key login using `HOSTINGER-SSH-SETUP.md`.
2. Copy `deploy.config.example.json` to `deploy.config.json`.
3. Fill in your SSH host, user, port, and remote theme path.
4. From this theme folder, run:

```powershell
.\deploy.ps1 "Describe the change"
```

That script will:

1. stage changes
2. create a commit
3. push to GitHub
4. connect to Hostinger over SSH
5. run `git pull` in the live theme folder

## What to replace

- Hero image:
  Replace it in `Appearance > Customize > BabyBloom Homepage > Hero Image`.
  Fallback file: `assets/images/hero-placeholder.svg`
- Category images:
  Replace them by setting WooCommerce category thumbnails.
  Fallback file: `assets/images/category-placeholder.svg`
- Homepage text:
  Most hero, announcement, CTA, and footer fields are in the Customizer section above.
- Navigation labels and link order:
  Manage them in `Appearance > Menus`.
- Brand colors:
  Edit the CSS variables at the top of `style.css`.
  Main variables: `--bb-blush`, `--bb-peach`, `--bb-cream`, `--bb-beige`, `--bb-mint`, `--bb-heading`, `--bb-text`
- Fonts:
  The theme enqueues `Baloo 2` for headings and `Nunito Sans` for body text in `functions.php`.

## WooCommerce notes

- The homepage product block uses live WooCommerce data via `[products limit="4" columns="4" orderby="popularity"]`.
- Product card styling is handled in `style.css` under the `.woocommerce ul.products li.product` rules.
- If you want a different parent theme later, update the `Template:` value in `style.css` and review any Storefront-specific cleanup in `functions.php`.
