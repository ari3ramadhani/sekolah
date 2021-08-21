<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi <b>{{Auth::user()->name}}</b>
            <b style="float:right;">Total Users
            <span class="badge badge-danger">{{count($users)}}</span>
            </b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container"> 
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Daftar</th>
                  </tr>
                </thead>
                <tbody>
@php($i = 1)

                    @foreach ($users as $user)
                  <tr>
                    <th scope="row">{{$i++}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                  {{-- Ini kalo pake eloquent --}}
                    {{-- <td>{{ $user->created_at->diffForHumans()}}</td> --}}
            {{-- ==================== --}}
                    {{-- Ini pake quey builder --}}
                    <td>{{Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</td>
            {{-- ==================== --}}
                  
                  </tr>
                    
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
</x-app-layout>
