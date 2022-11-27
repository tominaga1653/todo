<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            TO DO <span class="text-sm px-3">タスク編集</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                <form action="/tasks/{{ $task->id }}" method="post" class="mt-10">
                      @csrf
                      @method('PUT')
  
                      <div class="flex flex-col items-center">
                          <label class="w-full max-w-3xl mx-auto">
                              <input
                                  class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-4 pl-4 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm"
                                  type="text" name="task_name" value="{{ $task->name }}" />
                              @error('task_name')
                                  <div class="mt-3">
                                      <p class="text-red-500">
                                          {{ $message }}
                                      </p>
                                  </div>
                              @enderror
                          </label>
  
                          <div class="mt-8 w-full flex items-center justify-center gap-10">
                              <a href="/tasks" class="block shrink-0 underline underline-offset-2">
                                  戻る
                              </a>
                              <button type="submit"
                                  class="p-4 bg-sky-800 text-white rounded-md w-full max-w-xs hover:bg-sky-900 transition-colors">
                                  編集する
                              </button>
                          </div>
                      </div>
  
                  </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>