@if($totalCount > 0)
    <sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        @for($i = 1; $i <= $totalCount; $i++)
        <sitemap>
            @if($type == 'product')
            <loc>{{url('/product-sitemap.xml?page=').$i}}</loc>
            @elseif($type == 'post')
            <loc>{{url('/post-sitemap.xml?page=').$i}}</loc>
            @endif
        </sitemap>
        @endfor
    </sitemapindex>
@else
    <urlset xmlns:xsi="https://www.w3.org/2001/XMLSchema-instance" xmlns="https://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="https://www.google.com/schemas/sitemap-image/1.1"
        xsi:schemaLocation="https://www.sitemaps.org/schemas/sitemap/0.9 https://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd">
    @if(!empty($data))
        @foreach($data as $item)
            <url>
                @if($type == 'product')
                <loc>{{url($item->URL)}}.html</loc>
                @elseif($type == 'post')
                <loc>{{url($item->URL)}}</loc>
                @elseif($type == 'page')
                <loc>{{url($item->URL)}}.html</loc>
                @elseif($type == 'category' || $type == 'brand')
                <loc>{{url($item->URL)}}.html</loc>
                @endif
                <changefreq>always</changefreq>
                <priority>0.9</priority>
            </url>
        @endforeach
    @endif
    </urlset>
@endif