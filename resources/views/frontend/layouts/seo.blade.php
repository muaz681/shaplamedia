
<meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ isset($seo->meta_title) ? $seo->meta_title : 'Shapla Media' }}</title>
    <meta name="description" content="{{ str_replace(array("\r", "\n"), '', isset($seo->meta_description) ? $seo->meta_description : null) }}">
    <meta name="keywords" content="{{ isset($seo->meta_keywords) ? $seo->meta_keywords : null }}">
    <link rel="canonical" href="{{ isset($seo->canonical_tag) ? url($seo->canonical_tag) : null }}" />
    <meta property="og:site_name" content="Shapla Media" />
    <meta property="og:locale" content="en" />
    <meta property="og:type" content="{{ isset($seo->og_type) ? $seo->og_type : (isset($seo->meta_type) ? $seo->meta_type : 'article') }}" />
    <meta property="og:image:alt" content="{{ isset($seo->meta_title) ? $seo->meta_title : 'Shapla Media' }}" />
    <meta property="og:title" content="{{ isset($seo->meta_title) ? $seo->meta_title : null }}" />
    <meta property="og:description" content="{{ str_replace(array("\r", "\n"), '', isset($seo->meta_description) ? $seo->meta_description : null) }}" />
    <meta property="og:url" content="{{ isset($seo->canonical_tag) ? url($seo->canonical_tag) : null }}" />

    <meta property="og:image" content="{{ isset($seo->meta_image) ? $seo->meta_image : url('assets/frontend/images/social.png') }}" />
    <meta property="fb:pages" content="{{ null }}" />
