<meta name="Generator" content="OCMS 0 (https://ocms.tech)">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="MobileOptimized" content="width">
<meta name="HandheldFriendly" content="true">
<meta charset="UTF-8">

{% set title = get_title() %}

<title>{{ title }}</title>
<meta property="og:title" content="{{ title }}">
<meta name="twitter:title" content="{{ title }}" />

{#{% if keywords -%}#}
{#	<meta name="keywords" content="{{ keywords }}"/>#}
{#{%- endif %}#}

{#{% if description -%}#}
{#	<meta name="description" content="{{ description }}">#}
{#	<meta property="og:description" content="{{ description }}" />#}
{#	<meta name="twitter:description" content="{{ description }}">#}
{#{%- endif %}#}

{#{% if ogImage -%}#}
{#	<meta property="og:image" content="{{ ogImage }}">#}
{#{%- endif %}#}

{#{% if twitterImage -%}#}
{#	<meta name="twitter:image" content="">#}
{#	<meta name="twitter:card" content="summary_large_image">#}
{#{%- endif %}#}

{#{% if ogUrl -%}#}
{#	<meta property="og:image" content="{{ ogUrl }}">#}
{#{%- endif %}#}

{#{% if twitterSite -%}#}
{#	<meta property="og:image" content="{{ twitterSite }}">#}
{#{%- endif %}#}

{#{% if twitterCreator -%}#}
{#	<meta property="og:image" content="{{ twitterCreator }}">#}
{#{%- endif %}#}

<link rel="stylesheet" href="{{ layout_dir }}css/style.min.css">
<link rel="stylesheet" href="{{ layout_dir }}css/custom.css">

<script src="{{ layout_dir }}js/modernizr.js"></script>
