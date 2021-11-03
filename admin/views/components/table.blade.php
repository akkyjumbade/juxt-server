<div class="table-container">
   <table class="table table-hover">
      <thead>
         <tr>
            @foreach ($columns as $col)
            <th>{{ __($col) }}</th>
            @endforeach
         </tr>
      </thead>
      <tbody>
         {{ $slot }}
      </tbody>
   </table>
</div>
