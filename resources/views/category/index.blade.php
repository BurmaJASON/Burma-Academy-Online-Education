<x-layout>
    <!-- ================ Order Details List ================= -->
    <div class="details">
        <x-recentOrders :categories='$categories'></x-recentOrders>


        <!-- ================= New Customers ================ -->
        @isset($category)

            <x-recentStudents :category='$category' ></x-recentStudents>
        @else
            <x-recentStudents ></x-recentStudents>
        @endisset
    </div>
</x-layout>
