<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
        <div class="app-sidebar__user">
                <div class="text-center">
                        <p class="app-sidebar__user-name">{{ auth()->user()->name }}</p>
                </div>
        </div>
        <ul class="app-menu">
                <li><a class="app-menu__item {{ Request::is('home') ? 'active':'' }}" href="{{ url('/home') }}"><i
                                        class="app-menu__icon fa fa-dashboard"></i><span
                                        class="app-menu__label">Dashboard</span></a></li>


                <li
                        class="treeview {{ Request::is('reports/accounts_dashboard') ? 'is-expanded':Formatter::checkAccountingUrl(Request::segment(1)) }}">
                        <a class="app-menu__item" href="#" data-toggle="treeview"><i
                                        class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Account
                                        and Finance</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                        <ul class="treeview-menu">
                                <li><a class="treeview-item {{ Request::is('report/accounts_dashboard') ? 'active':'' }}"
                                                href="{{ url('reports/accounts_dashboard')}}"><i
                                                        class="icon fa fa-book"></i>
                                                Accounts Dashboard </a>
                                </li>
                                <li><a class="treeview-item" href="{{ route('assets.create')}}"><i
                                                        class="icon fa fa-circle-o"></i> Add Asset </a>
                                </li>
                                <li><a class="treeview-item" href="{{ route('assets.store')}}"><i
                                                        class="icon fa fa-circle-o"></i> Asset List</a></li>


                                <li>
                                        <a class="treeview-item {{ Request::is('payment_vouchers/create') ? 'active':'' }}"
                                                href="{{ route('payment_vouchers.create') }}"><i
                                                        class="icon fa fa-circle-o"></i> Add Payment Voucher </a>
                                </li>
                                <li>
                                        <a class="treeview-item {{ Request::is('payment_vouchers/create') ? 'active':'' }}"
                                                href="{{ route('payment_vouchers.index') }}"><i
                                                        class="icon fa fa-circle-o"></i> Payment Voucher List</a>
                                </li>
                                <li>
                                        <a class="treeview-item {{ Request::is('receive_vouchers/create') ? 'active':'' }}"
                                                href="{{ route('receive_vouchers.create') }}"><i
                                                        class="icon fa fa-circle-o"></i> Add Receive Voucher </a>
                                </li>
                                <li>
                                        <a class="treeview-item {{ Request::is('receive_vouchers/create') ? 'active':'' }}"
                                                href="{{ route('receive_vouchers.index') }}"><i
                                                        class="icon fa fa-circle-o"></i> Receive Voucher List</a>
                                </li>

                                <li>
                                        <a class="treeview-item {{ Request::is('journal_vouchers/create') ? 'active':'' }}"
                                                href="{{ route('journal_vouchers.create') }}"><i
                                                        class="icon fa fa-circle-o"></i> Add Journal Voucher </a>
                                </li>
                                <li>
                                        <a class="treeview-item {{ Request::is('journal_vouchers/create') ? 'active':'' }}"
                                                href="{{ route('journal_vouchers.index') }}"><i
                                                        class="icon fa fa-circle-o"></i> Journal Voucher List</a>
                                </li>

                                <li>
                                        <a class="treeview-item {{ Request::is('contra_vouchers/create') ? 'active':'' }}"
                                                href="{{ route('contra_vouchers.create') }}"><i
                                                        class="icon fa fa-circle-o"></i> Add Contra /
                                                Transfer </a>
                                </li>
                                <li>
                                        <a class="treeview-item {{ Request::is('contra_vouchers/create') ? 'active':'' }}"
                                                href="{{ route('contra_vouchers.index') }}"><i
                                                        class="icon fa fa-circle-o"></i> Contra /
                                                Transfer List</a>
                                </li>


                        </ul>
                </li>

                <li class="treeview {{ Formatter::checkAccountingSettingsUrl(Request::segment(1)) }}"><a
                                class="app-menu__item" href="#" data-toggle="treeview"><i
                                        class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Account
                                        Settings</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                        <ul class="treeview-menu">
                                <li><a href="{{ url('opening_assets') }}"
                                                class="treeview-item {{ Request::is('opening_assets') ? 'active':'' }}">
                                                <i class="icon fa fa-circle-o"></i>Opening Asset
                                        </a></li>
                                <li><a class="treeview-item {{ Request::is('chart_of_accounts') ? 'active':'' }}"
                                                href="{{ url('chart_of_accounts')}}"><i class="icon fa fa-circle-o"></i>
                                                Chart Of Account List </a>
                                </li>
                                <li><a class="treeview-item {{ Request::is('account-information') ? 'active':'' }}"
                                                href="{{ url('account-information')}}"><i
                                                        class="icon fa fa-circle-o"></i> Account Information
                                                List </a></li>
                                <li><a class="treeview-item {{ Request::is('payment-method') ? 'active':'' }}"
                                                href="{{ url('payment-method')}}"><i class="icon fa fa-circle-o"></i>
                                                Payment Method List </a></li>
                                <li><a class="treeview-item {{ Request::is('party') ? 'active':'' }}"
                                                href="{{ url('party')}}"><i class="icon fa fa-circle-o"></i> Supplier
                                                List </a>
                                </li>
                                <li><a class="treeview-item {{ Request::is('vendors') ? 'active':'' }}"
                                                href="{{ url('vendors')}}"><i class="icon fa fa-circle-o"></i> Buyer
                                                List </a>
                                </li>

                        </ul>
                </li>



                <!--  MIS Report starts -->
                <li class="treeview {{ Request::segment(1) == 'reports' ? 'is-expanded':'' }}"><a
                                class="app-menu__item {{ Request::segment(1) == 'reports' }}" href="#"
                                data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span
                                        class="app-menu__label">MIS
                                        Report</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                        <ul class="treeview-menu">
                                {{-- accounts report --}}
                                <li> <a href="#" class="treeview-item">--- Accounts Report ---</a></li>
                                <li><a class="treeview-item {{ Request::is('reports/trial_balance') ? 'active':'' }}"
                                                href="{{ url('reports/trial_balance') }}"><i
                                                        class="icon fa fa-book"></i>
                                                Trial Balance Report </a>
                                <li><a class="treeview-item {{ Request::is('reports/ledger_balance') ? 'active':'' }}"
                                                href="{{ url('reports/ledger_balance') }}"><i
                                                        class="icon fa fa-book"></i>
                                                Ledger Balance Report </a>
                                </li>
                                <li><a class="treeview-item {{ Request::is('reports/receivable_accounts') ? 'active':'' }}"
                                                href="{{ url('reports/receivable_accounts') }}"><i
                                                        class="icon fa fa-book"></i>
                                                Accounts Receivable </a>
                                </li>

                                <li><a class="treeview-item {{ Request::is('reports/payable_accounts') ? 'active':'' }}"
                                                href="{{ url('reports/payable_accounts') }}"><i
                                                        class="icon fa fa-book"></i>
                                                Accounts Payable </a>
                                </li>
                                <li><a class="treeview-item {{ Request::is('reports/income_statement') ? 'active':'' }}"
                                                href="#"><i class="icon fa fa-book"></i>
                                                Income Statement </a>
                                </li>
                                <li><a class="treeview-item {{ Request::is('reports/balance_sheet') ? 'active':'' }}"
                                                href="{{ url('reports/balance_sheet')}}"><i class="icon fa fa-book"></i>
                                                Balance Sheet </a>
                                </li>

                                <li><a class="treeview-item {{ Request::is('reports/income_expense') ? 'active':'' }}"
                                                href="{{ url('reports/income_expense') }}"><i
                                                        class="icon fa fa-book"></i>
                                                Income Expense Report
                                        </a></li>
                                <li><a class="treeview-item {{ Request::is('reports/chart_balance') ? 'active':'' }}"
                                                href="{{ url('reports/chart_balance') }}"><i
                                                        class="icon fa fa-book"></i>
                                                Chart of Account Balance Report
                                        </a></li>


                                {{-- production report --}}
                                <li> <a href="#" class="treeview-item">--- Production Report ---</a></li>
                                <li><a class="treeview-item {{ Request::is('reports/opening_raw_material_stocks') ? 'active':'' }}"
                                                href="{{ url('reports/opening_raw_material_stocks') }}"><i
                                                        class="icon fa fa-circle-o"></i> Opening Raw Material
                                                Stock</a>
                                </li>
                                <li><a class="treeview-item {{ Request::is('reports/raw_material_stocks') ? 'active':'' }}"
                                                href="{{ url('reports/raw_material_stocks') }}"><i
                                                        class="icon fa fa-circle-o"></i> Raw Material
                                                Stock</a>
                                </li>
                                <li><a class="treeview-item {{ Request::is('reports/raw_material_batch_stocks') ? 'active':'' }}"
                                                href="{{ url('reports/raw_material_batch_stocks') }}"><i
                                                        class="icon fa fa-circle-o"></i> Raw Material
                                                Stock (Batch)</a>
                                </li>
                                <li><a class="treeview-item {{ Request::is('reports/sheet_material_stocks') ? 'active':'' }}"
                                                href="{{ url('reports/sheet_material_stocks') }}"><i
                                                        class="icon fa fa-circle-o"></i> Sheet
                                                Stock</a>
                                </li>
                                {{-- <li><a class="treeview-item {{ Request::is('reports/sheet_stocks') ? 'active':'' }}"
                                href="{{ url('reports/sheet_stocks') }}"><i class="icon fa fa-circle-o"></i>
                                RM Wise Sheet Stock</a>
                </li> --}}
                {{-- <li><a class="treeview-item {{ Request::is('reports/wastage_stocks') ? 'active':'' }}"
                href="{{ url('reports/wastage_stocks') }}"><i class="icon fa fa-circle-o"></i> Wastage Stock</a>
                </li> --}}
                <li><a class="treeview-item {{ Request::is('reports/kutcha_wastage_stocks') ? 'active':'' }}"
                                href="{{ url('reports/kutcha_wastage_stocks') }}"><i
                                        class="icon fa fa-circle-o"></i>Kutcha
                                Wastage Stock</a>
                </li>
                <li><a class="treeview-item {{ Request::is('reports/kutcha_summary_report') ? 'active':'' }}"
                                href="{{ url('reports/kutcha_summary_report') }}"><i class="icon fa fa-circle-o"></i>
                                Kutcha Summary Report</a>
                </li>
                <li><a class="treeview-item {{ Request::is('reports/haddi_powder_stocks') ? 'active':'' }}"
                                href="{{ url('reports/haddi_powder_stocks') }}"><i class="icon fa fa-circle-o"></i>Haddi
                                Powder Stock</a>
                </li>
                <li><a class="treeview-item {{ Request::is('reports/product_summary_report') ? 'active':'' }}"
                                href="{{ url('reports/product_summary_report') }}"><i class="icon fa fa-circle-o"></i>
                                Product
                                Summary Report</a>
                </li>
                <li><a class="treeview-item {{ Request::is('reports/product_stocks') ? 'active':'' }}"
                                href="{{ url('reports/product_stocks') }}"><i class="icon fa fa-circle-o"></i> Product
                                Stock</a>
                </li>

                <li>
                        <a class="treeview-item {{ Request::is('reports/product_branch_stocks') ? 'active':'' }}"
                                href="{{ url('reports/product_branch_stocks') }}"><i class="icon fa fa-circle-o">
                                        Product Stock (Branch)
                                </i></a>
                </li>

                </li>


        </ul>
        </li>
        <!-- MIS Report Ends  -->



        <li class="treeview {{ Request::segment(1) == 'production_settings' ? 'is-expanded':'' }}"><a
                        class="app-menu__item {{ Request::segment(1) == 'colors' }}" href="#" data-toggle="treeview"><i
                                class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Production
                                Settings</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                        <li>
                                <a href="{{ url('production_settings/opening_sub_raw_materials') }}"
                                        class="treeview-item {{ Request::is('production_settings/opening_sub_raw_materials') ? 'active':'' }}">
                                        <i class="icon fa fa-circle-o"></i>Opening Raw Material Stock
                                </a>
                        </li>
                        <li><a href="{{ url('production_settings/opening_fm_kutchas') }}"
                                        class="treeview-item {{ Request::is('production_settings/opening_fm_kutchas') ? 'active':'' }}">
                                        <i class="icon fa fa-circle-o"></i>Opening Fm Kutcha Stock
                                </a></li>
                        <li>
                                <a href="{{ url('production_settings/opening_products') }}"
                                        class="treeview-item {{ Request::is('production_settings/opening_products') ? 'active':'' }}">
                                        <i class="icon fa fa-circle-o"></i>Opening Product Stock
                                </a>
                        </li>
                        <li>
                                <a href="{{ url('production_settings/opening_sheets') }}"
                                        class="treeview-item {{ Request::is('production_settings/opening_sheets') ? 'active':'' }}">
                                        <i class="icon fa fa-circle-o"></i>Opening Sheet Stock
                                </a>
                        </li>
                        <li>
                                <a href="{{ url('production_settings/opening_haddi_powders') }}"
                                        class="treeview-item {{ Request::is('production_settings/opening_haddi_powders') ? 'active':'' }}">
                                        <i class="icon fa fa-circle-o"></i>Opening Haddi Powder Stock
                                </a>
                        </li>

                        <li><a class="treeview-item {{ Request::is('production_settings/batches') ? 'active':'' }}"
                                        href="{{ route('batches.index') }}"><i class="icon fa fa-circle-o"></i>
                                        Batch List </a></li>

                        <li><a class="treeview-item {{ Request::is('production_settings/branches') ? 'active':'' }}"
                                        href="{{ route('branches.index') }}"><i class="icon fa fa-circle-o"></i>
                                        Branch List </a></li>

                        <li><a class="treeview-item {{ Request::is('production_settings/colors') ? 'active':'' }}"
                                        href="{{ route('colors.index') }}"><i class="icon fa fa-circle-o"></i>
                                        Color List </a></li>

                        <li><a class="treeview-item {{ Request::is('production_settings/raw_materials') ? 'active':'' }}"
                                        href="{{ route('raw_materials.index') }}"><i class="icon fa fa-circle-o"></i>
                                        Raw
                                        Material List </a></li>

                        <li><a class="treeview-item {{ Request::is('production_settings/sub_raw_materials') ? 'active':'' }}"
                                        href="{{ route('sub_raw_materials.index') }}"><i
                                                class="icon fa fa-circle-o"></i> Sub Raw
                                        Material List </a></li>

                        <li><a class="treeview-item {{ Request::is('production_settings/products') ? 'active':'' }}"
                                        href="{{ route('products.index') }}"><i class="icon fa fa-circle-o"></i>
                                        Finish
                                        Product List </a></li>

                        <li><a class="treeview-item {{ Request::is('production_settings/machines') ? 'active':'' }}"
                                        href="{{ route('machines.index') }}"><i class="icon fa fa-circle-o"></i>
                                        Machine List </a></li>

                        <li><a class="treeview-item {{ Request::is('production_settings/sheet_sizes') ? 'active':'' }}"
                                        href="{{ route('sheet_sizes.index') }}"><i class="icon fa fa-circle-o"></i>
                                        Sheet
                                        Size List </a></li>

                        <li><a class="treeview-item {{ Request::is('production_settings/fm_kutchas') ? 'active':'' }}"
                                        href="{{ route('fm_kutchas.index') }}"><i class="icon fa fa-circle-o"></i> Fm
                                        Kutcha List </a></li>

                </ul>
        </li>

        <li class="treeview {{ Request::segment(1) == 'purchases' ? 'is-expanded':'' }}"><a
                        class="app-menu__item {{ Request::segment(1) == 'purchases' ? 'active':'' }}" href="#"
                        data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span
                                class="app-menu__label">Purchase
                                Order</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                        <li><a class="treeview-item {{ Request::is('purchases/create') ? 'active':'' }}"
                                        href="{{ route('purchases.create') }}"><i class="icon fa fa-circle-o"></i>Add
                                        Purchase Order</a>
                        </li>
                        <li><a class="treeview-item {{ Request::is('purchases') ? 'active':'' }}"
                                        href="{{ route('purchases.index') }}"><i class="icon fa fa-circle-o"></i>
                                        Purchase
                                        Order List </a></li>
                </ul>
        </li>
        <li class="treeview {{ Request::segment(1) == 'purchase_receives' ? 'is-expanded':'' }}"><a
                        class="app-menu__item {{ Request::segment(1) == 'purchase_receives' ? 'active':'' }}" href="#"
                        data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span
                                class="app-menu__label">Chalan
                                Receive</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                        <li><a class="treeview-item {{ Request::is('purchase_receives/create') ? 'active':'' }}"
                                        href="{{ route('purchase_receives.create') }}"><i
                                                class="icon fa fa-circle-o"></i>Add Chalan
                                        Receive</a></li>
                        <li><a class="treeview-item {{ Request::is('purchase_receives') ? 'active':'' }}"
                                        href="{{ route('purchase_receives.index') }}"><i
                                                class="icon fa fa-circle-o"></i> Chalan
                                        Receive List </a>
                        </li>
                </ul>
        </li>
        <li
                class="treeview {{ Request::segment(1) == 'temporary_sheet_productions' || Request::segment(1) == 'sheet_productions' ? 'is-expanded':'' }}">
                <a class="app-menu__item {{ Request::is('sheet_productions') ? 'active':'' }}" href="#"
                        data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span
                                class="app-menu__label">Sheet
                                Production</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                        <li><a class="treeview-item {{ Request::is('temporary_sheet_productions/create') ? 'active':'' }}"
                                        href="{{ route('temporary_sheet_productions.create') }}"><i
                                                class="icon fa fa-circle-o"></i>Add Production
                                        Sheet</a>
                        </li>
                        <li><a class="treeview-item {{ Request::is('temporary_sheet_productions') ? 'active':'' }}"
                                        href="{{ route('temporary_sheet_productions.index') }}"><i
                                                class="icon fa fa-circle-o"></i>
                                        Draft Production Sheet List </a>
                        </li>
                        <li><a class="treeview-item {{ Request::is('sheet_productions') ? 'active':'' }}"
                                        href="{{ route('sheet_productions.index') }}"><i
                                                class="icon fa fa-circle-o"></i>
                                        Approved Production Sheet List </a>
                        </li>
                </ul>
        </li>
        {{-- <li class="treeview {{ Request::segment(1) == 'wastages' ? 'is-expanded':'' }}"><a
                class="app-menu__item {{ Request::is('wastages') ? 'active':'' }}" href="#" data-toggle="treeview"><i
                        class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Wastage</span><i
                        class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
                <li><a class="treeview-item {{ Request::is('wastages') ? 'active':'' }}"
                                href="{{ route('wastages.index') }}"><i class="icon fa fa-circle-o"></i>
                                Wastage List </a></li>
                <li><a class="treeview-item {{ Request::is('wastages/create') ? 'active':'' }}"
                                href="{{ route('wastages.create') }}"><i class="icon fa fa-circle-o"></i>Add
                                Wastage</a></li>
        </ul>
        </li> --}}
        <li
                class="treeview {{ Request::segment(1) == 'temporary_daily_productions' ? 'is-expanded':'' || Request::segment(1) == 'daily_productions' ? 'is-expanded':'' }}">
                <a class="app-menu__item {{ Request::segment(1) == 'daily_productions' ? 'active':'' }}" href="#"
                        data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span
                                class="app-menu__label">Finish
                                Production</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                        <li><a class="treeview-item {{ Request::is('temporary_daily_productions/create') ? 'active':'' }}"
                                        href="{{ route('temporary_daily_productions.create') }}"><i
                                                class="icon fa fa-circle-o"></i>Add Finish
                                        Production</a>
                        </li>
                        <li><a class="treeview-item {{ Request::is('temporary_daily_productions') ? 'active':'' }}"
                                        href="{{ route('temporary_daily_productions.index') }}"><i
                                                class="icon fa fa-circle-o"></i> Pending Finish
                                        Production List </a>
                        </li>
                        <li><a class="treeview-item {{ Request::is('daily_productions') ? 'active':'' }}"
                                        href="{{ route('daily_productions.index') }}"><i
                                                class="icon fa fa-circle-o"></i> Approved Finish
                                        Production List </a>
                        </li>
                </ul>
        </li>
        <li
                class="treeview {{ Request::segment(1) == 'temporary_direct_productions' || Request::segment(1) == 'direct_productions' ? 'is-expanded':'' }}">
                <a class="app-menu__item {{ Request::segment(1) == 'direct_productions' ? 'active':'' }}" href="#"
                        data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span
                                class="app-menu__label">Direct
                                Production</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                        <li><a class="treeview-item {{ Request::is('temporary_direct_productions/create') ? 'active':'' }}"
                                        href="{{ route('temporary_direct_productions.create') }}"><i
                                                class="icon fa fa-circle-o"></i>Add Draft Direct
                                        Production</a>
                        </li>
                        <li><a class="treeview-item {{ Request::is('temporary_direct_productions') ? 'active':'' }}"
                                        href="{{ route('temporary_direct_productions.index') }}"><i
                                                class="icon fa fa-circle-o"></i> Draft Direct
                                        Production List </a>
                        </li>
                        <li><a class="treeview-item {{ Request::is('direct_productions') ? 'active':'' }}"
                                        href="{{ route('direct_productions.index') }}"><i
                                                class="icon fa fa-circle-o"></i> Approved Direct
                                        Production List </a>
                        </li>
                </ul>
        </li>

        <li class="treeview {{ Request::segment(1) == 'product_stock_transfers' ? 'is-expanded':'' }}"><a
                        class="app-menu__item {{ Request::segment(1) == 'product_stock_transfers' ? 'active':'' }}"
                        href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span
                                class="app-menu__label">Product Stock Tranfer</span><i
                                class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                        <li><a class="treeview-item {{ Request::is('product_stock_transfers/create') ? 'active':'' }}"
                                        href="{{ route('product_stock_transfers.create') }}"><i
                                                class="icon fa fa-circle-o"></i>Add Product Stock Transfer</a></li>
                        <li><a class="treeview-item {{ Request::is('product_stock_transfers') ? 'active':'' }}"
                                        href="{{ route('product_stock_transfers.index') }}"><i
                                                class="icon fa fa-circle-o"></i>
                                        Product Stock Transfer List </a>
                        </li>
                </ul>
        </li>
        <li class="treeview {{ Request::segment(1) == 'sale_quotations' ? 'is-expanded':'' }}"><a
                        class="app-menu__item {{ Request::segment(1) == 'sale_quotations' ? 'active':'' }}" href="#"
                        data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span
                                class="app-menu__label">Sale Quotation</span><i
                                class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                        <li><a class="treeview-item {{ Request::is('sale_quotations/create') ? 'active':'' }}"
                                        href="{{ route('sale_quotations.create') }}"><i
                                                class="icon fa fa-circle-o"></i>Add Sale Quotation</a></li>
                        <li><a class="treeview-item {{ Request::is('sale_quotations') ? 'active':'' }}"
                                        href="{{ route('sale_quotations.index') }}"><i class="icon fa fa-circle-o"></i>
                                        Sale Quotation List </a>
                        </li>
                </ul>
        </li>

        <li class="treeview {{ Request::segment(1) == 'sales' ? 'is-expanded':'' }}"><a
                        class="app-menu__item {{ Request::segment(1) == 'sales' ? 'active':'' }}" href="#"
                        data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span
                                class="app-menu__label">Order Receive</span><i
                                class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                        <li><a class="treeview-item {{ Request::is('sales/create') ? 'active':'' }}"
                                        href="{{ route('sales.create') }}"><i class="icon fa fa-circle-o"></i>Add Order
                                        Receive</a></li>
                        <li><a class="treeview-item {{ Request::is('sales') ? 'active':'' }}"
                                        href="{{ route('sales.index') }}"><i class="icon fa fa-circle-o"></i>
                                        Order Receive List </a>
                        </li>
                </ul>
        </li>
        <li class="treeview {{ Request::segment(1) == 'product_deliveries' ? 'is-expanded':'' }}"><a
                        class="app-menu__item {{ Request::segment(1) == 'product_deliveries' ? 'active':'' }}" href="#"
                        data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span
                                class="app-menu__label">Delivery
                                Chalan</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                        <li><a class="treeview-item {{ Request::is('product_deliveries/create') ? 'active':'' }}"
                                        href="{{ route('product_deliveries.create') }}"><i
                                                class="icon fa fa-circle-o"></i>Add Delivery
                                        Chalan</a>
                        </li>
                        <li><a class="treeview-item {{ Request::is('product_deliveries') ? 'active':'' }}"
                                        href="{{ route('product_deliveries.index') }}"><i
                                                class="icon fa fa-circle-o"></i>
                                        Delivery Chalan List </a>
                        </li>
                </ul>
        </li>



        <li class="treeview {{ Request::segment(1) == 'users' ? 'is-expanded':'' }}"><a
                        class="app-menu__item {{ Request::segment(1) == 'users' }}" href="#" data-toggle="treeview"><i
                                class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">User</span><i
                                class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                        <li><a class="treeview-item {{ Request::is('users/add-new') ? 'active':'' }}"
                                        href="{{ url('users/add-new') }}"><i class="icon fa fa-circle-o"></i> Add New
                                        User</a></li>
                        <li><a class="treeview-item {{ Request::is('users/list') ? 'active':'' }}"
                                        href="{{ url('users/list') }}"><i class="icon fa fa-circle-o"></i> User List</a>
                        </li>


                        <li><a class="treeview-item {{ Request::is('users/edit') ? 'active':'' }}"
                                        href="{{ url('users/edit') }}"><i class="icon fa fa-circle-o"></i> Edit
                                        Profile</a></li>
                        <li><a class="treeview-item {{ Request::is('users/change_password') ? 'active':'' }}"
                                        href="{{ url('users/change_password') }}"><i
                                                class="icon fa fa-circle-o"></i>Change Password</a>
                        </li>
                </ul>
        </li>



        <li class="treeview {{ Request::segment(1) == 'companies' ? 'is-expanded':'' }}"><a
                        class="app-menu__item {{ Request::segment(1) == 'companies' }}" href="#"
                        data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span
                                class="app-menu__label">Company</span><i
                                class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                        <li><a class="treeview-item {{ Request::is('companies') ? 'active':'' }}"
                                        href="{{ route('companies.index') }}"><i class="icon fa fa-circle-o"></i>
                                        Company List </a>
                        </li>
                        {{-- <li><a class="treeview-item {{ Request::is('companies/create') ? 'active':'' }}"
                        href="{{ route('companies.create') }}"><i class="icon fa fa-circle-o"></i>Add
                        Company</a>
        </li>--}}
        </ul>
        </li>

        </ul>
</aside>

@section('js')
<script>
        // let url = $(location).attr('href');
        // let appMenu = $('ul.app-menu li');
        // appMenu.each(function(){
        //   let a = $(this).children('a');
        //   if(a.attr('href') == url){
        //     a.parent('li').addClass('active');
        //   }
        // });
</script>
@endsection