<!doctype html>
<html lang="fr">
<head>
    @include('Include/header');
    <title>Namek - Mon panier</title>

    <!-- CSS LOGIN -->
    <link rel="stylesheet" href="{{ asset('css/style-panier.css') }}">
</head>
<body>
    <section class="h-100 h-custom">
        <div class="container py-5 h-100 container-panier">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    @if ($content->isEmpty())
                        <div style="text-align: center">
                            <h5>Votre panier est vide</h5>

                            <h6 class="mb-0" style="text-align:center">
                                <a href="/produit" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Retour à la boutique</a>
                            </h6>
                        </div>
                    @else
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-lg-8">
                                    <div class="p-5">
                                        <div class="d-flex justify-content-between align-items-center mb-5">
                                            <h1 class="fw-bold mb-0">Mon panier</h1>
                                        </div>
                                        <hr class="my-4">
                                        @foreach($content as $produit)
                                            <form method="POST" action="{{route('panier_supp', $produit->id)}}" id="form-panier">
                                                @csrf
                                                @method('DELETE')
                                                <div class="row mb-4 d-flex justify-content-between align-items-center">
                                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                                        <a href="{{ route('detail_produit', $produit->id) }}" id="redirection-produit">
                                                            <img src="{{ asset('img/Products/'. $produit->attributes['image']) }}" class="img-fluid rounded-3" alt="Image produit ajouter ">
                                                        </a>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                                        <h6 class="text-muted">3gr</h6>
                                                        <h5 class="text-black mb-0 margin-tel">{{$produit->name}}</h5>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex margin-tel">
                                                        <input id="form1" min="1" name="quantity" value="{{ $produit->quantity }}" type="number"
                                                        class="form-control form-control-sm quantite-produit" disabled />
                                                    </div>
                                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1 margin-tel">
                                                        <h5 class="mb-0" style="color: #499b4a">{{ number_format($produit->attributes['prix_ttc'], 2) }} CHF</h5>
                                                    </div>
                                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end" id="removeProduit">
                                                        <button type="submit" class="btn btn-danger" id="button-remove" title="supprimer"><i class="fas fa-times"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                            <hr class="my-4">
                                        @endforeach

                                        <div class="pt-5">
                                            <h6 class="mb-0"><a href="/produit" class="text-body"><i
                                                        class="fas fa-long-arrow-alt-left me-2"></i>Retour à la boutique</a></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 bg-grey">
                                    <div class="p-5">
                                        <h3 class="fw-bold mb-5 mt-2 pt-1">Résumé</h3>
                                        <hr class="my-4">

                                        <h5 class="text-uppercase mb-3">Code promo</h5>

                                        <div class="mb-4">
                                            <div class="form-outline">
                                                <form action="{{ route('panier_promo') }}" method="POST">
                                                    @csrf
                                                    <input type="text" id="codePromo" name="codePromo" class="form-control form-control-lg" />
                                                    <input type="submit" name="submit" id="input" style="background: #499b4a;color:white;">
                                                </form><br>
                                                @error('codePromo')
                                                    <div class="alert alert-danger">
                                                        <span>{{ $message }}</span>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <hr class="my-4">
                                        @if(Session::has('codePromo'))
                                            <div class="d-flex justify-content-between">
                                                <h5 class="text-uppercase">CODE <span style="color:red">{{ $discount_name }}</u></U></span></h5>
                                                <span style="font-weight: bold">{{ $discount_pourcentage }}%</span>
                                                <h5 id="livraison">- {{ number_format($reduction, 2) }} CHF</h5>
                                                <form method="POST" action="{{route('promo_remove')}}" id="form-panier">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" id="button-remove" title="supprimer"><i class="fas fa-times"></i></button>
                                                </form>
                                            </div>

                                        <hr class="my-3">
                                        @endif

                                        <div class="d-flex justify-content-between mb-5">
                                            <h5 class="text-uppercase">Total HT</h5>
                                            <h5 id="prix-ht'">{{number_format($total_ht_panier, 2)}} CHF</h5>
                                        </div>
                                        <div class="d-flex justify-content-between mb-5">
                                            <h5 class="text-uppercase">Frais TVA (7.7 %)</h5>
                                            <h5 id="tva">{{number_format($tva, 2)}} CHF</h5>
                                        </div>
                                        <div class="d-flex justify-content-between mb-5">
                                            <h5 class="text-uppercase">Frais Livraison</h5>
                                            <h5 id="livraison">0</h5>
                                        </div>

                                        <div class="d-flex justify-content-between mb-5">
                                            <h5 class="textuppercase">Total TTC</h5>
                                            <h5 id="prix-ttc">{{number_format($total_ttc_panier, 2)}} CHF</h5>
                                        </div>
                                        <!-- SI CONNECTE -->
                                        @if(\Illuminate\Support\Facades\Auth::check())
                                            <!-- SI PANIER VIDE -->
                                            @if($total_ttc_panier == 0)
                                                <button disabled type="button" class="btn btn-block btn-lg button-panier" style="background: gray;color: white;" data-mdb-ripple-color="red">Votre panier est vide</button>
                                            <!-- SI PANIER NON VIDE -->
                                            @else
                                                <a href="/checkout"><button type="button" class="btn btn-dark btn-block btn-lg button-panier" data-mdb-ripple-color="dark">Commander</button></a>
                                            @endif
                                        <!-- PAS CONNECTE -->
                                        @else
                                            <a href="/login"><button type="button" class="btn btn-dark btn-block btn-lg button-panier" data-mdb-ripple-color="dark">Se connecter</button></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @include('Include/footer')
</body>
