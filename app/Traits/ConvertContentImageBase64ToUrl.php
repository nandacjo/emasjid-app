<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

/**
 * Convert contetn image baset 64 to url
 */
trait ConvertContentImageBase64ToUrl
{
    protected function convertContentImageBase64TouUrl($konten)
    {
        $pattern = '/<img.*?src="(data:image\/(.*?);base64,.*?)".*?>/i';
        preg_match_all($pattern, $konten, $matches);
        $gambarBase64 = $matches[1];
        $masjidId = auth()->user()->masjid_id;

        foreach ($gambarBase64 as $gambar) {
            $data = explode(',', $gambar);
            $gambarData = $data[1];
            $mime = $data[0];
            $mimeParts = explode('/', $mime);

            // Mendapatak ekstensi file dari tipe MIME menggunakn pustak finfo
            $finfo = finfo_open();
            $ext = finfo_buffer($finfo, base64_decode($gambarData), FILEINFO_MIME_TYPE);
            finfo_close($finfo);

            $ext = explode('/', $ext)[1];

            $namaFile = "profil/$masjidId/" . uniqid() . '.' . $ext;
            Storage::disk('public')->put($namaFile, base64_decode($gambarData));
            $namaFile = "/storage/$namaFile";
            $konten = str_replace($gambar, $namaFile, $konten);
        }
        return $konten;
    }

    public function setAttribute($key, $value)
    {
        if ($key === $this->contentName) {
            $value = $this->convertContentImageBase64TouUrl($value);
        }

        return parent::setAttribute($key, $value);
    }
}
