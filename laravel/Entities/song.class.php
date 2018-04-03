<?php //IDEA:

class Song
{
    public $songID;
    public $songTitle;
    public $artist;
    public $songIMGLINK;
    public $songLink;
    public $tags;
    public $likes;
    public $dislikes;
    public $descr;
    public $uploader;
    public $uploadDate;

    public function __construct($songTitle,$artist,$songIMGLINK,$songLink, $descr, $uploader)
    {
        $this->songID = $songID;
        $this->songTitle = $songID;
        $this->artist=$artist;
        $this->songIMGLINK=$songIMGLINK;
        $this->songLink = $songLink;
        $this->descr = $descr;
        $this->uploader = $uploader;
    }

    //Save music 
    public function save()
    {
        $songTitle = $request->input('song_title');
        $artist = $request->input('artist');
        $tags = 0;
        $likes = 0;
        $dislikes = 0;
        $descr = $request->input('txtDescr');
        $uploader = $request->input('txtUploader');
        $uploadDate = $request->input('txtUploadDate');
        DB::insert('INSERT INTO Product (SONG_TITLE , ARTIST
        , SONG_IMGL_INK, SONG_LINK, TAGS, LIKES, DISLIKES, DESCR, UPLOADER, UPLOAD_DATE',
        [$songTitle], [$artist], [$filepath], [$tags], [$likes], [$dislikes], [$descr], [$uploader], [$uploadDate]);

        // DB::insert('insert into student (name) values(?)',[$name]);
        echo "Record inserted successfully.<br/>";
        echo '<a href = "/insert">Click Here</a> to go back.';

        // $db=new Db();
        // $sql = "INSERT INTO Product (SONG_TITLE , ARTIST, SONG_IMGL_INK, SONG_LINK, TAGS, LIKES, DISLIKES, DESCR, UPLOADER, UPLOAD_DATE) VALUES 
        // ('$this->songTitle','$this->artist''$filepath','$this->tags','$this->likes','$this->dislikes','$this->descr','$this->uploader','$this->uploadDate')";

        // $result = $db->query_execute($sql);
        // return $result;
    }

    //Create new music 
    public function createNewMusic()
    {
        $file_temp = $this->picture['tmp_name'];
        $user_file = $this->picture['name'];
        $timestamp = date("Y").date("m").date("d").date("h").date("i").date("s");
        $filepath = "uploads/".$timestamp.$user_file;
        if(move_uploaded_file($file_temp, $filepath)==false)
        {
            return false;
        }

        $db=new Db();
        $sql = "INSERT INTO Product (SONG_TITLE , ARTIST, SONG_IMGL_INK, SONG_LINK, TAGS, LIKES, DISLIKES, DESCR, UPLOADER, UPLOAD_DATE) VALUES 
        ('$this->songTitle','$this->artist''$filepath','$this->tags','$this->likes','$this->dislikes','$this->descr','$this->uploader','$this->uploadDate')";

        $result = $db->query_execute($sql);
        return $result;
    }

    public static function list_product()
    {
        $db = new Db();
        $sql = "SELECT * FROM product";
        $result = $db->select_to_array($sql);
        return $result;
    }
}

?>