@extends('layouts.app')

@section('title', 'Task Manager | Dashboard')

@section('content')
    @if(session('error'))
        <script>
            alert("{!! session('error') !!}");
        </script>
    @endif

    @if(session('success'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050">
            <div id="successToast" class="toast align-items-center text-bg-success border-0 show" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var successToast = new bootstrap.Toast(document.getElementById("successToast"));
                successToast.show();
            });
        </script>
    @endif


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if($projects->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No projects yet</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating a new project.</p>
                    <div class="mt-6">
                        <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                            + Create Project
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($projects as $project)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition">
                            <div class="p-6">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center space-x-3 flex-1">
                                        <div class="w-4 h-4 rounded" style="background-color: {{ $project->color }}"></div>
                                        <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $project->name }}</h3>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('projects.edit', $project) }}" class="text-gray-400 hover:text-gray-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                
                                @if($project->description)
                                    <p class="mt-2 text-sm text-gray-600 line-clamp-2">{{ $project->description }}</p>
                                @endif

                                <div class="mt-4">
                                    <div class="flex justify-between text-sm text-gray-500 mb-2">
                                        <span>Progress</span>
                                        <span>{{ $project->getCompletionPercentage() }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="h-2 rounded-full transition-all" 
                                             style="width: {{ $project->getCompletionPercentage() }}%; background-color: {{ $project->color }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 flex items-center justify-between text-sm">
                                    <div class="flex space-x-4 text-gray-500">
                                        <span>{{ $project->tasks_count }} tasks</span>
                                        <span>{{ $project->getTaskCountByStatus('done') }} done</span>
                                    </div>
                                    <a href="{{ route('projects.show', $project) }}" class="text-blue-500 hover:text-blue-600 font-medium">
                                        View →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
    