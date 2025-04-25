@extends('layouts.app')
@section('title', 'Media Storage')
@section('content')
        <!-- The container for media -->
        <div class="container d-grid" style="display: grid; grid-template-columns: 1fr 1fr 1fr;">
            <x-card
                title="HolyC"
                :keywords="['C','C++','HolyC', 'Programming']"
                descr="The best programming language!"
                image="https://upload.wikimedia.org/wikipedia/commons/thumb/3/33/HolyC_Logo.svg/306px-HolyC_Logo.svg.png"
            />
            <x-card
                title="Java"
                :keywords="['Java','OOP','JVM', 'Programming']"
                descr="Ловушка Джавы ☺"
                image="https://cdn4.iconfinder.com/data/icons/logos-and-brands/512/181_Java_logo_logos-512.png"
            />
            <x-card
                title="Default"
            />
        </div>
@endsection
