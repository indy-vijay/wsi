<?php 
namespace Controller;
use \Customers;
use \Address;
use \Communication;
use \Orders;
use \OrderLine;
use \States;
use \Artworks as ArtworksModel;
use \Artworksplacements as ArtworksplacementsModel;
use \OrderArtworks;
use \Desc;
use \Brands;
use \Styles;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Products extends \SlimController\SlimController
{

	/* Ajax function to return the styles related to a brand */
	public function getStylesForBrandAction($brand_id)
	{
		echo json_encode(Brands::findOrFail($brand_id)->styles->toArray());
	}

	/* Ajax function to return the colors related to a style */
	public function getColorsForStyleAction($style_id)
	{
		echo json_encode(Styles::findOrFail($style_id)->colors->toArray());
	}

	public function getBrandsForDescAction($desc_id)
	{
		echo json_encode(Desc::findOrFail($desc_id)->brands->toArray());
	}

}