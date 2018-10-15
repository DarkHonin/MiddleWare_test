<?php

namespace DB;

class EQuery{
    const   QUERY_PART = "NONE";
}

final class EQueryCreate extends EQuery{
    const   QUERY_PART = "CREATE";
    const   DATABASE = 0;
    const   TABLE = 1;
}

?>