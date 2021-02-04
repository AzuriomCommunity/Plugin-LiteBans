@extends('layouts.app')

@section('title', 'Plugin home')

@section('content')
<div class="container content">
 <h1>Sanctions</h1>

 <div class="row justify-content-center mt-5">
  <div class="col-md-8">
   <div class="card">
    <div class="card-header">Erreur</div>

    <div class="card-body text-center">
     <h2>Impossible de se connecter à la base de données</h2>
     <p>Veuillez vérifier les identifiants de votre base de données litebans.</p>

     <a href="http://azuriom.test" class="btn btn-primary">Accueil</a>
    </div>
   </div>
  </div>
 </div>
</div>
@endsection