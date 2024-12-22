<div>

{{--        {{$user->created_at}}--}}

        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 text-center">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Name</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Email</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Phone</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Created_at</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                </tr>
                </thead>
                @foreach($this->users as $user)
                <tbody class="divide-y divide-gray-100 border-t border-gray-100 text-center">
                <tr class="hover:bg-gray-50">
                    <th>
                        <div class="text-sm">
                            <div class="font-medium text-gray-700">{{$user->name}}</div>
                        </div>
                    </th>
                    <td class="px-6 py-4">
          <span
              class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600"
          >
            <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
            {{$user->email}}

          </span>
                    </td>
                    <td class="px-6 py-4">{{$user->phone}}</td>
                    <td class="px-6 py-4">

                 <span
                                class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-2 py-1 text-xs font-semibold text-indigo-600"
                            >
              {{$user->created_at->format('d/m/y')}}
            </span>

                </tbody>
                @endforeach
            </table>
        </div>
</div>
