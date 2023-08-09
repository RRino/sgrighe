<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**

     * Write code on Method

     *

     * @return response()

     */

    protected $fillable = [

        'title', 'description'

    ];

  

    /**

     * Get the user's first name.

     */

    protected function description(): Attribute

    {

        return Attribute::make(

            set: fn (string $value) => $this->makeBodyContent($value),

        );

    }

  

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function makeBodyContent($content)

    {

        $dom = new \DomDocument();

        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $imageFile = $dom->getElementsByTagName('img');

       

        foreach($imageFile as $item => $image){

            $data = $image->getAttribute('src');

            list($type, $data) = explode(';', $data);

            list(, $data)      = explode(',', $data);

            $imgeData = base64_decode($data);

            $image_name= "/uploads/" . time().$item.'.png';

            $path = public_path() . $image_name;

            file_put_contents($path, $imgeData);

                 

            $image->removeAttribute('src');

            $image->setAttribute('src', $image_name);

        }

       

        return $dom->saveHTML();

    }
}
