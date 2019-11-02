@extends('layout.master')
@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible"  role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {!!session('success')!!}
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            @if(Auth::check())
                <h4>bạn đã đăng nhập rồi</h4>
            @else
                <div class="checkout-area-dang-nhap">
                    <h3>Thông tin đăng nhập</h3>
                    <form action="" method="post">
                        <table class="table table-bordered">
                            <tr>
                                <th>Tên đăng nhập</th>
                                <td><input class="form-control" type="text" name="txtEmail"></td>
                            </tr>
                            <tr>
                                <th>Mật khẩu</th>
                                <td><input class="form-control" type="password" name="txtPassword"></td>
                            </tr>
                            <tr>
                                <th colspan="2">
                                    <button class="btn btn-primary">Đăng nhập</button>
                                </th>
                            </tr>
                        </table>
                        {{csrf_field()}}
                </form>
                </div>
            @endif
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Thông tin khách hàng</h4>
                        <input type="text" name="email" class="form-control" placeholder="email">
                        <h4>Địa chỉ giao hàng</h4>
                        <input type="text" name="full_name" placeholder="Họ và tên" class="form-control">
                        <br/>
                        <input type="text" name="phone_number" placeholder="Số điện thoại" class="form-control">
                        <br/>
                        <textarea class="form-control" placeholder="Địa chỉ" name="address"></textarea>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary" href="">Thanh toán</button>
                        </div>
                    </div>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
        <div class="col-md-6">
            <h3>Chi tiết đơn hàng</h3>
            <div class='block_wrap row'>
                @if(Cart::count() > 0)
                    <table class='table table-bordered responsive-table table--no-border'>
                        <thead class='cart__row small-hidden'>
                        <tr>
                            <th class="text-left cart__table-cell-image">Sản phẩm</th>
                            <th class="text-center cart__table-cell--meta"></th>
                            <th class="text-center cart__table-cell--price">Đơn giá</th>
                            <th class="text-center cart__table-cell--quantity">Số lượng</th>
                            <th class="text-right cart__table-cell--total-price">Tổng</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(Cart::content() as $cart)
                            <?php 	$cart_product = App\Product::find($cart->id);
                            ?>
                            <tr class='responsive-table__row'>

                                <td class="text-left cart__table-cell-image"><img src="uploaded/product/{{$cart->options->image}}" width='100%'/></td>
                                <td class="cart__table-cell--meta small--text-center"><p>
                                        <a href="san-pham/{{$cart->id}}/{{$cart_product->slug_name}}.html"><h6>{{$cart->name}}</h6></a>

                                    </p>
                                    <p><a href="javascript:void(0)" class='btn-del__cart-item remove-product-item' data-rowId='{{$cart->rowId}}'>Remove</a></p>
                                </td>
                                <td class="cart__table-cell--price medium-up--text-center" data-label='Đơn giá'>{{number_format($cart->price)}} vnđ</td>
                                <td class='cart__table-cell--quantity medium-up--text-center' data-label='Số lượng'>
                                    <select class="single-option-selector quantity-selector" data-option="option1" data-rowId='{{$cart->rowId}}'>
                                        @for($i = 1; $i<=20 ; $i++)
                                            <option value="{{$i}}" @if($cart->qty == $i) selected @endif >{{$i}}</option>
                                        @endfor
                                    </select>
                                </td>
                                <td class='cart__table-cell--quantity text-right quantity-{{$cart->rowId}}' data-label="Tổng">{{number_format($cart->subtotal)}} vnđ</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class='cart-footer text-right'>
                        <?php $total_price = Cart::subtotal(0,'','');
                        $ship_price = 0;
                        ?>

                        <p class='small--text-center'>
                            <span>Tổng tiền: </span>
                            <span class='span__total_price'>{{number_format($total_price)}} vnđ</span>
                        </p>
                    </div>

                @else
                    <p>Chưa có sản phẩm nào trong Giỏ hàng</p>
                @endif
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <button class="btn btn-primary">Thanh toán</button>
            </div>
        </div>
    </div>
@endsection
