<x-layout>
    <a href="{{ route('comments') }}" class="btn btn-primary ms-4" >Back</a>
    <div class="detail">

        <div class="recentOrders">
            <div class="cardHeaders">
                <h3>Comments - {{ $comments->total() }}</h3>
            </div>

            @if (count($comments) != 0)
                <table>
                    <thead>
                        <tr>
                            <td>Author</td>
                            <td>Comment</td>
                            <td>Date</td>
                            <td>Delete</td>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($comments as $index => $comment)
                            <tr>
                                <td class="col-2">{{ $comment->author->user_name }}</td>
                                <td >
                                    <div style="overflow: auto; max-height: 60px; padding-right: 20px;">
                                        {{ $comment->body }}
                                    </div>
                                </td>
                                <td class="col-2">{{ $comment->updated_at->diffForHumans() }}</td>
                                <td class="col-1">
                                    <form action="{{ route('comment#delete',$comment->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"  class="btn btn-link-primary">
                                            <ion-icon name="trash"></ion-icon>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $comments->links() }}
            @else
                <h1 class="text-center text-secondary mt-5">There is no Comments to show Here!</h1>
            @endif
        </div>
    </div>
</x-layout>

