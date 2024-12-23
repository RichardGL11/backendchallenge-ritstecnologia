<div>
    <div>


        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 text-center">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Order ID</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Owner</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Owner's Email</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Status</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Created_at</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                </tr>
                </thead>
                @foreach($this->orders as $order)
                    <tbody class="divide-y divide-gray-100 border-t border-gray-100 text-center">
                    <tr class="hover:bg-gray-50">
                        <th>
                            <div class="text-sm">
                                <div class="font-medium text-gray-700">{{$order->id}}</div>
                            </div>
                        </th>
                        <td class="px-6 py-4">
          <span
              class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600"
          >
            <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
            {{$order->user->name}}

          </span>
                        </td>
                        <td>
                            <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                            {{$order->user->email}}
                            </span></td>
                        <td class="px-6 py-4 text-red-500">{{$order->status}}</td>
                        <td class="px-6 py-4">

                 <span
                     class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-2 py-1 text-xs font-semibold text-indigo-600"
                 >
              {{$order->created_at->format('d/m/y')}}
            </span>
                    <td class="text-black">
                        <a href="#">See Items</a>
                    </td>

                    </tbody>
                @endforeach
            </table>
        </div>
    </div>

</div>
