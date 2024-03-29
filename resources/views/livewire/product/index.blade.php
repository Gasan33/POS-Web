<div>
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="card-tools">
                @can('products-create')
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"> </i> Add Product
                    </a>
                @endcan
                
            </div>
            <div class="row">
                <div class="col-md-6">
                    <input type="search" wire:model="search" class="form-control" placeholder="Search">
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select wire:model.lazy="category_id" class="form-control select2 select2-hidden-accessible">
                            <option value="" selected>Category..</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Category
                        </th>
                        <th>
                            Purchase Price
                        </th>
                        <th>
                            Sale Price
                        </th>
                        <th>
                            Profit
                        </th>
                        <th>
                            Stock
                        </th>
                        <th>
                            Image
                        </th>
                        <th class="text-center">
                            Status
                        </th>
                        <th>
                            ...
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $index=>$product)
                    <tr>
                        <td>
                            {{ $index + 1 }}
                        </td>
                        <td>
                            {{ $product->name }}
                        </td>
                        <td>
                            {{ $product->category->name }}
                        </td>
                        <td>
                            {{ $product->purchase_price }}
                        </td>
                        <td>
                            {{ $product->sale_price }}
                        </td>
                        <td>
                            {{ $product->profit_percent }}%
                        </td>
                        <td>
                            {{ $product->stock }}
                        </td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <img alt="Avatar" class="table-avatar" src="{{ asset('storage/'. $product->image) }}">
                                </li>
                            </ul>
                        </td>
                        <td class="project-state">
                            <span class="badge badge-{{ $product->active? 'success':'danger' }}">{{
                                $product->active?
                                'Active':'Not Active' }}</span>
                        </td>
                        <td class="">
                            <div class="btn-group">
                                {{-- Edit button --}}
                                @can('products-update')
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                @endcan
                                {{-- Delete Button --}}
                                @can('products-delete')
                                    <button 
                                        wire:click.prevent="setAtt('{{ $product->id }}', '{{$product->name}}')" 
                                        data-toggle="modal" data-target="#delete" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endcan

                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr><td>NO Data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div wire:ignore.self class="modal fade show" id="delete" aria-modal="true" tabindex="" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you want delete <b>{{$product_name}}</b> ?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" wire:click="deleteProduct" class="btn btn-danger"
                        data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.btndelete').click(function(){
        let id = $('.btndelete').attr('data-id');
        $('#userid').val(id);
    });
</script>