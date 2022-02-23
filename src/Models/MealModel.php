<?php

namespace PhpKnight\WeMeal\Models;

use PhpKnight\WeMeal\Admin\CPT\Meal\PriceMetaBox;
use PhpKnight\WeMeal\Helper;
use WP_Post;

class MealModel {

	/**
	 * @var WP_Post
	 */
	protected $meal;

	/**
	 * @var int
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var string
	 */
	protected $description;

	/**
	 * @var float
	 */
	protected $price;

	/**
	 * @var string
	 */
	protected $formatted_price;

	/**
	 * @var string
	 */
	protected $image;

	/**
	 * MealModel constructor.
	 */
	public function __construct( $meal = null ) {
		$this->meal = $meal;
	}

	/**
	 * @return int
	 */
	public function get_id(): int {
		$this->id = $this->meal->ID;

		return $this->id;
	}

	/**
	 * @param int $id
	 *
	 * @return MealModel
	 */
	public function set_id( int $id ): MealModel {
		$this->id = $id;

		return $this;
	}

	/**
	 * @return string
	 */
	public function get_name(): string {
		$this->name = $this->meal->post_title;

		return $this->name;
	}

	/**
	 * @param string $name
	 *
	 * @return MealModel
	 */
	public function set_name( string $name ): MealModel {
		$this->name = $name;

		return $this;
	}

	/**
	 * @return string
	 */
	public function get_description(): string {
		$this->description = wp_strip_all_tags( $this->meal->post_content, true );

		return $this->description;
	}

	/**
	 * @param string $description
	 *
	 * @return MealModel
	 */
	public function set_description( string $description ): MealModel {
		$this->description = $description;

		return $this;
	}

	/**
	 * @return float
	 */
	public function get_price(): float {
		$this->price = floatval( get_post_meta( $this->meal->ID, PriceMetaBox::$price_meta_key, true ) );

		return $this->price;
	}

	/**
	 * @param float $price
	 *
	 * @return MealModel
	 */
	public function set_price( float $price ): MealModel {
		$this->price = $price;

		return $this;
	}

	/**
	 * @return string
	 */
	public function get_formatted_price(): string {
		$this->formatted_price = Helper::format_price( $this->get_price() );

		return $this->formatted_price;
	}

	/**
	 * @param string $formatted_price
	 *
	 * @return MealModel
	 */
	public function set_formatted_price( string $formatted_price ): MealModel {
		$this->formatted_price = $formatted_price;

		return $this;
	}

	/**
	 * @param string $size
	 *
	 * @return string
	 */
	public function get_image( string $size = 'thumbnail' ): string {
		$this->image = get_the_post_thumbnail_url( $this->meal->ID, $size );

		return $this->image;
	}

	/**
	 * @param string $image
	 *
	 * @return MealModel
	 */
	public function set_image( string $image ): MealModel {
		$this->image = $image;

		return $this;
	}

	/**
	 * Gets the meal object based on the arguments.
	 *
	 * @param array $ids
	 * @param string $search
	 *
	 * @return array
	 */
	public function get( array $ids = [], string $search = '' ): array {
		$result = [];

		$defaults = [
			'post_type'   => 'meal',
			'post_status' => 'publish',
			'orderby'     => 'title',
			'order'       => 'ASC',
			's'           => '',
			'numberposts' => 5,
		];

		$args = [
			'post__in' => array_map( 'intval', $ids ),
			's'        => sanitize_text_field( $search ),
		];

		$posts = get_posts( wp_parse_args( $args, $defaults ) );

		foreach ( $posts as $post ) {
			$meal = new MealModel( $post );

			$result[] = [
				'id'              => $meal->get_id(),
				'name'            => $meal->get_name(),
				'description'     => $meal->get_description(),
				'price'           => $meal->get_price(),
				'formatted_price' => $meal->get_formatted_price(),
				'image'           => $meal->get_image(),
			];
		}

		return $result;
	}

}
