@extends('home')
@section('category')
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" style="margin-top: 2%;width: 100%;">
        <div id="myCarousels" class="carousel slide" data-bs-ride="carousel" style="">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#myCarousels" data-bs-slide-to="0" class="active">
                    @foreach($categories as $categorie)
                        <button type="button" data-bs-target="#myCarousels" data-bs-slide-to="{{ $categorie->id_category }}"></button>
                    @endforeach

                </div>

                <div class="carousel-inner" style="border-radius: 1%;">
                    <!--DIAPO 1-->
                    <div class="carousel-item active" id="carousel-categorie">
                        <a href="/produit">
                            <img style="filter: grayscale(20%);" class="bd-placeholder-img" width="100%" height="100%" src="{{asset('img/home/NosProduits.jpeg')}}" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></img>
                        </a>
                    </div>
                    <!-- RESTE DES DIAPO -->
                    @foreach($categories as $categorie)
                    <div class="carousel-item" id="carousel-categorie" style="border-radius: 1%;">
                        <a href="{{ route('voir_products_par_cat', ['id'=>$categorie->id_category]) }}">
                            <img style="filter: grayscale(20%);" class="bd-placeholder-img" width="100%" height="100%" src="{{ asset('img/home/'.$categorie->image_category) }}" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></img>
                        </a>
                    </div>
                    @endforeach

                    <!-- FLECHE SUIVANT/PRECEDANT -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousels" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#myCarousels" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('rss')
<br>
	<section class="bg-dark" style="margin-top:2%">
	    <div class="container">
            <div id="carouselThreeColumn" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselThreeColumn" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselThreeColumn" data-slide-to="1"></li>
                    <li data-target="#carouselThreeColumn" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-inner">
                            @foreach ($rss->slice(0, 9) as $key => $rssProduct )
                                @if($key % 3 == 0)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" id="carousel-item-height">
                                        <div class="row" id="rss-row">
                                            <div class="col-md-6 col-lg-4 mb-4 mb-lg-0 div-produit-content">
                                                <div class="card" style="box-shadow: 0 15px 20px -12px #499b4a;">
                                                    <img src="{{ asset('img/Products/'. $rssProduct->image_product)}}" class="card-img-top" alt="lemon haze" />
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between mb-3">
                                                            <h5 class="mb-0">{{ $rssProduct->name_product }}</h5>
                                                            <h5 class="text-dark mb-0">{{ $rssProduct->prixTTC()}} CHF</h5>
                                                        </div>
                                                        <div class="d-flex flex-row">
                                                            <a href="{{ route('detail_produit', ['id'=>$rssProduct->id_product]) }}" style="width:100%;" class="btn-green">
                                                                <button type="button" class="btn flex-fill ms-1 view-product-button" style="width: 100%;">VOIR LE PRODUIT</button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(isset($rss[$key+1]))
                                                <?php $rssProduct2 = $rss[$key+1]; ?>
                                                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0 div-produit-content">
                                                    <div class="card" style="box-shadow: 0 15px 20px -12px #499b4a;">
                                                        <img src="{{ asset('img/Products/'. $rssProduct2->image_product)}}" class="card-img-top" alt="lemon haze" />
                                                        <div class="card-body">
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <h5 class="mb-0">{{ $rssProduct2->name_product }}</h5>
                                                                <h5 class="text-dark mb-0">{{ $rssProduct2->prixTTC()}} CHF</h5>
                                                            </div>
                                                            <div class="d-flex flex-row">
                                                                <a href="{{ route('detail_produit', ['id'=>$rssProduct2->id_product]) }}" style="width:100%;" class="btn-green">
                                                                    <button type="button" class="btn flex-fill ms-1 view-product-button" style="width: 100%;">VOIR LE PRODUIT</button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(isset($rss[$key+2]))
                                                <?php $rssProduct3 = $rss[$key+2]; ?>
                                                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0 div-produit-content">
                                                    <div class="card" style="box-shadow: 0 15px 20px -12px #499b4a;">
                                                        <img src="{{ asset('img/Products/'. $rssProduct3->image_product)}}" class="card-img-top" alt="lemon haze" />
                                                        <div class="card-body">
                                                            <div class="d-flex justify-content-between mb-3">
                                                                <h5 class="mb-0">{{ $rssProduct3->name_product }}</h5>
                                                                <h5 class="text-dark mb-0">{{ $rssProduct3->prixTTC()}} CHF</h5>
                                                            </div>
                                                            <div class="d-flex flex-row">
                                                                <a href="{{ route('detail_produit', ['id'=>$rssProduct3->id_product]) }}" style="width:100%;" class="btn-green">
                                                                    <button type="button" class="btn flex-fill ms-1 view-product-button" style="width: 100%;">VOIR LE PRODUIT</button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    <a class="carousel-control-prev" href="#carouselThreeColumn" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselThreeColumn" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
	</section>
@endsection
