@extends('frontend.default.layouts.master')

@section('title')
    {{ localize('Commander sur place') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('breadcrumb-contents')
    <div class="breadcrumb-content">
        <h2 class="mb-2 text-center">{{ localize('Commande sur place') }}</h2>
        <nav>
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item fw-bold" aria-current="page"><a
                        href="{{ route('home') }}">{{ localize('Home') }}</a></li>
                <li class="breadcrumb-item fw-bold" aria-current="page">{{ localize('Commande sur place') }}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('contents')
    <!--breadcrumb-->
    @include('frontend.default.inc.breadcrumb')

    <section class="tt-campaigns ptb-100">
      <div class="container">
        <div class="row g-4">

        	
        	
      	</div>
      </div>
    </section>



@endsection