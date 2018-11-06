# BlockchainBot




$params = new Array(
	'' => '',
	'' => '',
	'' => '',
	'' => '',
	'' => '',
	'' => '',
	'' => '',
	'' => ''	
);


$bot = new Bot($params);
$bot.run();


// BOT CLASS
class Bot
{
	public function __construct(){}
	
	public function run(){}
	
	public function buy(){}
	
	public function sell(){}
	
	
}


class BotManager
{
	private $bots;
	
	
	public __construct( $bots = array() )
	{
		$this->setBots( $bots );
	}
	
	public setBots( $bots = array() )
	{
		
	}
	
	public getBots()
	{
		return $this->bots;
	}
	
	
	
}

