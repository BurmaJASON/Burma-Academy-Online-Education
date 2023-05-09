<x-layout>
        <x-cards :courses="$courses" :earning="$earning" :views="$views" :comments="$comments" ></x-cards>


        <!-- ================ Order Details List ================= -->
        <div class="details">
            <x-recentOrders :enrollments="$enrollments" ></x-recentOrders>

            <!-- ================= New Customers ================ -->
            <x-recentStudents :students="$students"></x-recentStudents>
        </div>
</x-layout>
