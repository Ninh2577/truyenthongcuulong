$cases = \App\Models\CaseStudy::orderBy('order')->orderBy('id', 'desc')->get();
foreach ($cases as $c) {
    echo "ID: {$c->id} | Group: {$c->group} | Title: {$c->title} | Slug: {$c->slug} | Cover: {$c->cover_image_url} | Thumb: {$c->thumbnail}\n";
}
