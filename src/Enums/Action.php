<?php
namespace App\Enums;

enum Action: string {
    case ADD_VOUCHERS          = "add_vouchers";
    case EDIT_VOUCHERS         = "edit_vouchers";
    case GET_COUNTRIES         = "get_countries";
    case GET_COUNTRY_BY_REGION = 'get_country_regions';
    case GET_COVERAGES         = "get_coverages";
    case GET_DOCUMENT_TYPES    = "get_document_types";
    case GET_REGIONS           = "get_regions";
    case GET_PRODUCTS          = "get_products";
    case GET_PRODUCT_ID        = "get_product_id";
    case GET_TARIFFS           = "get_tariffs";
    case GET_ALL_VOUCHERS      = "get_vouchers";
    case GET_VOUCHER           = "get_voucher";
    case GET_VOUCHER_PRICE     = "get_voucher_price";
    case REQUIRE_ANNULATION    = "require_voucher_annulation";
    case GET_UPGRADES          = "get_ccoverages";
    case CHECK_VOUCHER         = "check_voucher";
    case GET_PRODUCT_COMISSION = "get_products_with_comissions";
    case GET_CURRENCIES        = "get_currencies";
    case COUNT_VOUCHERS        = "count_vouchers";
    case GET_VOUCHER_STATUS    = 'get_voucher_status';
}
