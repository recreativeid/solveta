import { NextRequest, NextResponse } from "next/server";
import { query } from "@/lib/db";

export async function GET() {
  try {
    // 1. Fetch site_copy
    const copyRows: any[] = await query("SELECT * FROM site_copy WHERE id = 1 LIMIT 1");
    const siteCopy = copyRows[0]
      ? {
          heroEyebrow: copyRows[0].hero_eyebrow,
          heroHeadline: copyRows[0].hero_headline,
          heroSubtitle: copyRows[0].hero_subtitle,
          portfolioTitle: copyRows[0].portfolio_title,
          portfolioSubtitle: copyRows[0].portfolio_subtitle || "",
          consultationTitle: copyRows[0].consultation_title,
          consultationDesc: copyRows[0].consultation_desc,
          marqueeTitle: copyRows[0].marquee_title,
        }
      : null;

    // 2. Fetch contact_info
    const contactRows: any[] = await query("SELECT * FROM contact_info WHERE id = 1 LIMIT 1");
    const contact = contactRows[0]
      ? {
          whatsappNumber: contactRows[0].whatsapp_number,
          whatsappDisplay: contactRows[0].whatsapp_display,
          websiteUrl: contactRows[0].website_url,
          email: contactRows[0].email,
        }
      : null;

    // 3. Fetch pricing_tiers
    const pricingRows: any[] = await query("SELECT * FROM pricing_tiers ORDER BY sort_order ASC");
    const pricing = pricingRows.map((r: any) => ({
      id: r.id,
      name: r.name,
      pricePrefix: r.price_prefix || undefined,
      price: r.price,
      popular: Boolean(r.popular),
      features: typeof r.features_json === "string" ? JSON.parse(r.features_json) : r.features_json,
      suitability: r.suitability,
      buttonLabel: r.button_label,
      buttonVariant: r.button_variant || "outline",
      waMessage: r.wa_message,
    }));

    // 4. Fetch portfolio_items
    const portfolioRows: any[] = await query("SELECT * FROM portfolio_items ORDER BY sort_order ASC, created_at DESC");
    const portfolio = portfolioRows.map((r: any) => ({
      id: r.id,
      title: r.title,
      category: r.category || undefined,
      image: r.image_url,
      description: r.description,
      tags: typeof r.tags_json === "string" ? JSON.parse(r.tags_json) : r.tags_json || [],
      liveUrl: r.live_url,
    }));

    // 5. Fetch client_brands
    const brandRows: any[] = await query("SELECT * FROM client_brands ORDER BY sort_order ASC, created_at ASC");
    const clientBrands = brandRows.map((r: any) => ({
      id: r.id,
      name: r.name || undefined,
      label: r.label || undefined,
      logoImage: r.logo_image || undefined,
    }));

    return NextResponse.json({
      success: true,
      data: {
        siteCopy,
        contact,
        pricing,
        portfolio,
        clientBrands,
      },
    });
  } catch (error: any) {
    console.error("Failed to fetch data from MySQL:", error.message);
    return NextResponse.json(
      { success: false, error: error.message },
      { status: 500 }
    );
  }
}

export async function POST(req: NextRequest) {
  try {
    const body = await req.json();
    const { siteCopy, contact, pricing, portfolio, clientBrands } = body;

    // 1. Update site_copy if provided
    if (siteCopy) {
      await query(
        `INSERT INTO site_copy (id, hero_eyebrow, hero_headline, hero_subtitle, portfolio_title, portfolio_subtitle, consultation_title, consultation_desc, marquee_title)
         VALUES (1, ?, ?, ?, ?, ?, ?, ?, ?)
         ON DUPLICATE KEY UPDATE
           hero_eyebrow = VALUES(hero_eyebrow),
           hero_headline = VALUES(hero_headline),
           hero_subtitle = VALUES(hero_subtitle),
           portfolio_title = VALUES(portfolio_title),
           portfolio_subtitle = VALUES(portfolio_subtitle),
           consultation_title = VALUES(consultation_title),
           consultation_desc = VALUES(consultation_desc),
           marquee_title = VALUES(marquee_title)`,
        [
          siteCopy.heroEyebrow,
          siteCopy.heroHeadline,
          siteCopy.heroSubtitle,
          siteCopy.portfolioTitle,
          siteCopy.portfolioSubtitle || "",
          siteCopy.consultationTitle,
          siteCopy.consultationDesc,
          siteCopy.marqueeTitle || "DIPERCAYA OLEH BERBAGAI BISNIS & INSTITUSI BERKEMBANG",
        ]
      );
    }

    // 2. Update contact_info if provided
    if (contact) {
      await query(
        `INSERT INTO contact_info (id, whatsapp_number, whatsapp_display, website_url, email)
         VALUES (1, ?, ?, ?, ?)
         ON DUPLICATE KEY UPDATE
           whatsapp_number = VALUES(whatsapp_number),
           whatsapp_display = VALUES(whatsapp_display),
           website_url = VALUES(website_url),
           email = VALUES(email)`,
        [
          contact.whatsappNumber,
          contact.whatsappDisplay,
          contact.websiteUrl,
          contact.email || "halo@solveta.site",
        ]
      );
    }

    // 3. Update pricing_tiers if provided
    if (pricing && Array.isArray(pricing)) {
      for (let i = 0; i < pricing.length; i++) {
        const tier = pricing[i];
        await query(
          `INSERT INTO pricing_tiers (id, name, price_prefix, price, popular, features_json, suitability, button_label, button_variant, wa_message, sort_order)
           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
           ON DUPLICATE KEY UPDATE
             name = VALUES(name),
             price_prefix = VALUES(price_prefix),
             price = VALUES(price),
             popular = VALUES(popular),
             features_json = VALUES(features_json),
             suitability = VALUES(suitability),
             button_label = VALUES(button_label),
             button_variant = VALUES(button_variant),
             wa_message = VALUES(wa_message),
             sort_order = VALUES(sort_order)`,
          [
            tier.id,
            tier.name,
            tier.pricePrefix || null,
            tier.price,
            tier.popular ? 1 : 0,
            JSON.stringify(tier.features),
            tier.suitability,
            tier.buttonLabel,
            tier.buttonVariant || "outline",
            tier.waMessage,
            i + 1,
          ]
        );
      }
    }

    // 4. Update portfolio_items if provided
    if (portfolio && Array.isArray(portfolio)) {
      // Clear existing and re-insert to keep sync clean
      await query("DELETE FROM portfolio_items");
      for (let i = 0; i < portfolio.length; i++) {
        const item = portfolio[i];
        await query(
          `INSERT INTO portfolio_items (id, title, category, image_url, description, tags_json, live_url, sort_order)
           VALUES (?, ?, ?, ?, ?, ?, ?, ?)`,
          [
            item.id,
            item.title,
            item.category || null,
            item.image,
            item.description,
            JSON.stringify(item.tags || []),
            item.liveUrl || "https://www.solveta.site",
            i + 1,
          ]
        );
      }
    }

    // 5. Update client_brands if provided
    if (clientBrands && Array.isArray(clientBrands)) {
      await query("DELETE FROM client_brands");
      for (let i = 0; i < clientBrands.length; i++) {
        const brand = clientBrands[i];
        await query(
          `INSERT INTO client_brands (id, name, label, logo_image, sort_order)
           VALUES (?, ?, ?, ?, ?)`,
          [
            brand.id || "brand-" + i,
            brand.name || null,
            brand.label || null,
            brand.logoImage || null,
            i + 1,
          ]
        );
      }
    }

    return NextResponse.json({ success: true, message: "Data successfully saved to MySQL database!" });
  } catch (error: any) {
    console.error("Failed to save data to MySQL:", error.message);
    return NextResponse.json(
      { success: false, error: error.message },
      { status: 500 }
    );
  }
}
