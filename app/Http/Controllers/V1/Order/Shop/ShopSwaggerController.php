<?php

namespace App\Http\Controllers\V1\Order;

use App\Http\Controllers\Controller;

class ShopSwaggerController extends Controller
{



	/* *********************************************************************
	*	CUISINES
	**********************************************************************/

	/**
	*@OA\Get(
	*	path="/api/v1/shop/cuisinelist/{id}", 
	*	operationId="apiv1.shop.cuisinelist",
	*	tags={"Shop"},
	*	@OA\Parameter(
	*		name="id",
	*		in="path",
	*		description="Store Type ID",
	*		required=true,
	*		@OA\Schema(type="integer")
	*	),
	*	@OA\Response(
	*		response="200",
	*		description="Returns shops Cuisinelist",
	*		@OA\JsonContent()
	*	),
	*	@OA\Response(
	*		response="422",
	*		description="Error: Unprocessable entity. When required parameters were not supplied."),
	*	security={ {"Shop": {}} },
	* )
	*/

		/* *********************************************************************
	*	SHOP DETAIL
	**********************************************************************/

	/**
	*@OA\Get(
	*	path="/api/v1/shop/shops/details/{id}",
	*	operationId="apiv1.shop.shops.list",
	*	tags={"Shop"},
	*	@OA\Parameter(
	*		name="id",
	*		in="path",
	*		description="Store ID",
	*		required=true,
	*		@OA\Schema(type="integer")
	*	),
	*	@OA\Parameter(
	*		name="filter",
	*		in="query",
	*		@OA\Schema(type="string")
	*	),
	*	@OA\Parameter(
	*		name="qfilter",
	*		in="query",
	*		@OA\Schema(type="string", enum={"non-veg", "pure-veg", "discount"})
	*	),
	*	@OA\Parameter(
	*		name="search",
	*		in="query",
	*		@OA\Schema(type="string")
	*	),
	*	@OA\Parameter(
	*		name="latitude",
	*		in="query",
	*		@OA\Schema(type="string", example="13.0389694")
	*	),
	*	@OA\Parameter(
	*		name="longitude",
	*		in="query",
	*		@OA\Schema(type="string", example="80.2095246")
	*	),
	*	@OA\Response(
	*		response="200",
	*		description="Update Shop Details",
	*		@OA\JsonContent()
	*	),
	*	@OA\Response(
	*		response="422",
	*		description="Error: Unprocessable entity. When required parameters were not supplied."),
	*	security={ {"Shop": {}} },
	* )
	*/

	/* *********************************************************************
	*	SHOW ADDONS
	**********************************************************************/

	/**
	*@OA\Get(
	*	path="/api/v1/shop/addon/{id}",
	*	operationId="apiv1.shop.addon",
	*	tags={"Shop"},
	*	@OA\Parameter(
	*		name="id",
	*		in="path",
	*		description="Store Id",
	*		required=true,
	*		@OA\Schema(type="integer")
	*	),
	*	@OA\Response(
	*		response="200",
	*		description="Returns All Addons of Particular Store",
	*		@OA\JsonContent()
	*	),
	*	@OA\Response(
	*		response="422",
	*		description="Error: Unprocessable entity. When required parameters were not supplied."),
	*	security={ {"Shop": {}} },
	* )
	*/ 


	/* *********************************************************************
	*	SHOP ORDER HISTORY
	**********************************************************************/

	/**
	*@OA\Get(
	*	path="/api/v1/shop/shoprequesthistory?",
	*	operationId="api.v1.shop.shoprequesthistory",
	*	tags={"Shop"},
	*	@OA\Parameter(
	*		name="limit",
	*		in="query",
	*		description="limit",
	*		required=false,
	*		@OA\Schema(type="integer", example="10")),
	*	@OA\Parameter(
	*		name="offset",
	*		in="query",
	*		description="offset",
	*		required=false,
	*		@OA\Schema(type="integer", example="0")),
	*	@OA\Parameter(
	*		name="type",
	*		in="query",
	*		description="ACCEPTED / COMPLETED / CANCELLED  / history . if ACCEPTED, 'Ongoing Requests'. if history, 'COMPLETED', All Past Completed 		 *		 Orders.   if history, 'CANCELLED', All Past CANCELLED Orders ",
	*		required=false,
	*		@OA\Schema(type="string", example="COMPLETED")),
	*	@OA\Response(
	*		response="200",
	*		description="Returns ",
	*		@OA\JsonContent()
	*	),
	*	@OA\Response(
	*		response="422",
	*		description="Error: Unprocessable entity. When required parameters were not supplied."),
	*	security={ {"Shop": {}} },
	* )
	*/

	/* *********************************************************************
	*	SHOW ORDER DETAILS
	**********************************************************************/

	/**
	*@OA\Get(
	*	path="/api/v1/shop/requesthistory/{id}",
	*	operationId="apiv1.shop.requesthistory",
	*	tags={"Shop"},
	*	@OA\Parameter(
	*		name="id",
	*		in="path",
	*		description="Store Order Id",
	*		required=true,
	*		@OA\Schema(type="integer")
	*	),
	*	@OA\Response(
	*		response="200",
	*		description="Returns Store Order Details with Invoice",
	*		@OA\JsonContent()
	*	),
	*	@OA\Response(
	*		response="422",
	*		description="Error: Unprocessable entity. When required parameters were not supplied."),
	*	security={ {"Shop": {}} },
	* )
	*/ 


	/* *********************************************************************
	*	SHOP ORDER HISTORY
	**********************************************************************/

	/**
	*@OA\Get(
	*	path="/api/v1/shop/dispatcher/orders?",
	*	operationId="api.v1.shop.dispatcher/orders",
	*	tags={"Shop"},	
	*	@OA\Parameter(
	*		name="type",
	*		in="query",
	*		description="ACCEPTED /ORDERED/ Dispacther . if ORDERED, 'Incoming  Requests'. if  'ACCEPTED', All Ongoing Orders",
	*       required=false,  
	*		@OA\Schema(type="string", example="ORDERED")),
	*	@OA\Response(
	*		response="200",
	*		description="Returns All Icoming and Accepted Orders",
	*		@OA\JsonContent()
	*	),
	*	@OA\Response(
	*		response="422",
	*		description="Error: Unprocessable entity. When required parameters were not supplied."),
	*	security={ {"Shop": {}} },
	* )
	*/


}