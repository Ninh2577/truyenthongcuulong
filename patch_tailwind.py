import re
import json

config = {
    colors: {
        on-secondary-container: #53617d,
        error: #ba1a1a,
        surface-container: #e5eeff,
        primary: #a33900,
        outline: #8e7166,
        inverse-on-surface: #eaf1ff,
        on-tertiary-container: #fffbff,
        inverse-primary: #ffb599,
        on-primary-fixed: #370e00,
        primary-container: #cc4900,
        on-surface: #0b1c30,
        surface-container-lowest: #ffffff,
        on-background: #0b1c30,
        primary-fixed: #ffdbce,
        on-tertiary-fixed: #2a1700,
        secondary-fixed-dim: #b8c7e6,
        outline-variant: #e2bfb2,
        on-primary-fixed-variant: #7f2b00,
        on-primary: #ffffff,
        surface-container-low: #eff4ff,
        surface-bright: #f8f9ff,
        on-surface-variant: #5a4138,
        on-tertiary: #ffffff,
        tertiary-fixed-dim: #ffb95f,
        on-tertiary-fixed-variant: #653e00,
        on-error-container: #93000a,
        tertiary-fixed: #ffddb8,
        on-secondary-fixed: #0c1c34,
        surface-container-high: #dce9ff,
        surface: #f8f9ff,
        surface-container-highest: #d3e4fe,
        on-secondary: #ffffff,
        secondary: #505f7a,
        tertiary: #825100,
        on-primary-container: #fffbff,
        background: #f8f9ff,
        primary-fixed-dim: #ffb599,
        surface-dim: #cbdbf5,
        surface-tint: #a73a00,
        on-secondary-fixed-variant: #394761,
        on-error: #ffffff,
        secondary-container: #ceddfe,
        inverse-surface: #213145,
        secondary-fixed: #d6e3ff,
        tertiary-container: #a36700,
        error-container: #ffdad6,
        surface-variant: #d3e4fe
    },
    spacing: {
        container-max: 80rem,
        gutter-desktop: 2rem,
        space-xl: 2rem,
        space-4xl: 6rem,
        space-2xs: 0.25rem,
        space-3xl: 4.5rem,
        space-xs: 0.5rem,
        gutter-tablet: 1.5rem,
        gutter-mobile: 1rem,
        space-lg: 1.5rem,
        space-md: 1rem,
        space-sm: 0.75rem,
        space-2xl: 3rem
    },
    fontFamily: {
        headline-lg: [Space Grotesk],
        body-md: [Plus Jakarta Sans],
        body-xl: [Plus Jakarta Sans],
        headline-sm: [Space Grotesk],
        display-hero-mobile: [Space Grotesk],
        display-hero: [Space Grotesk],
        headline-md: [Space Grotesk],
        headline-xl: [Space Grotesk],
        body-sm: [Plus Jakarta Sans],
        label-sm: [Plus Jakarta Sans],
        headline-accent: [Playfair Display],
        label-md: [Plus Jakarta Sans],
        headline-xl-mobile: [Space Grotesk],
        body-lg: [Plus Jakarta Sans]
    },
    fontSize: {
        headline-lg: [32px, {lineHeight: 40px, letterSpacing: -0.02em, fontWeight: 600}],
        body-md: [16px, {lineHeight: 24px, letterSpacing: 0em, fontWeight: 400}],
        body-xl: [20px, {lineHeight: 32px, letterSpacing: -0.005em, fontWeight: 400}],
        headline-sm: [20px, {lineHeight: 28px, letterSpacing: -0.01em, fontWeight: 600}],
        display-hero-mobile: [40px, {lineHeight: 48px, letterSpacing: -0.02em, fontWeight: 700}],
        display-hero: [64px, {lineHeight: 72px, letterSpacing: -0.03em, fontWeight: 700}],
        headline-md: [24px, {lineHeight: 32px, letterSpacing: -0.015em, fontWeight: 600}],
        headline-xl: [44px, {lineHeight: 52px, letterSpacing: -0.025em, fontWeight: 700}],
        body-sm: [14px, {lineHeight: 20px, letterSpacing: 0.005em, fontWeight: 400}],
        label-sm: [12px, {lineHeight: 16px, letterSpacing: 0.04em, fontWeight: 700}],
        headline-accent: [36px, {lineHeight: 44px, letterSpacing: 0.0em, fontWeight: 400}],
        label-md: [14px, {lineHeight: 20px, letterSpacing: 0.01em, fontWeight: 600}],
        headline-xl-mobile: [32px, {lineHeight: 40px, letterSpacing: -0.02em, fontWeight: 700}],
        body-lg: [18px, {lineHeight: 28px, letterSpacing: 0em, fontWeight: 400}]
    }
}

with open(tailwind.config.js, r, encoding=utf-8) as f:
    content = f.read()

for k, v in config.items():
    part = json.dumps(v, indent=4).strip()[1:-1]
    search_str = f{k}: {{
    if search_str in content:
        content = content.replace(search_str, f{k}: {{\\n{part},)
    else:
        # If not present, maybe we need to insert it
        content = content.replace(extend: {, fextend: {{\\n {k}: {{\\n{part}\\n}},)

with open(tailwind.config.js, w, encoding=utf-8) as f:
    f.write(content)

