## WMI - Windows Management Instrumentation in PHP

[![Travis CI](https://img.shields.io/travis/stevebauman/wmi.svg?style=flat-square)](https://travis-ci.org/stevebauman/wmi)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/stevebauman/wmi.svg?style=flat-square)](https://scrutinizer-ci.com/g/stevebauman/wmi/?branch=master)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/eb72d3fd-7464-41f1-928b-be774eb9e697.svg?style=flat-square)](https://insight.sensiolabs.com/projects/eb72d3fd-7464-41f1-928b-be774eb9e697)
[![Latest Stable Version](https://img.shields.io/packagist/v/stevebauman/wmi.svg?style=flat-square)](https://packagist.org/packages/stevebauman/wmi)

### Requirements

To use WMI, your server must meet the following requirements:

- Windows OS
- PHP 5.4 or Greater
- PHP COM extension enabled

### Installation

Insert WMI into your `composer.json`:

    "stevebauman/wmi": "1.0.*"
    
Now run `composer update`.

You're all set!

## Usage

### Connecting

To use WMI, you must create a new WMI instance. To interact with the current computer, just create a WMI instance:
    
    use Stevebauman\Wmi\Wmi;
    
    $wmi = new Wmi();

To interact with a PC on your network, you'll need to enter a host name, and a username and password if needed:

    $wmi = new Wmi($host = 'GUEST-PC', $username = 'guest', $password = 'password');

Now we can connect to it, but you'll need to specify the namespace you're looking to connect to:

    $wmi->connect('root\\cimv2');

The `connect()` method will return true or false if the connection was successful:

    if($connection = $wmi->connect('root\\cimv2'))
    {
        echo "Cool! We're connected.";
        
        $query = $connection->newQuery();
    } else
    {
        echo "Uh oh, looks like we couldn't connect.";
    }
    
### Querying

> **CAUTION**: Before we get started with queries, you should know that **NO VALUES** are escaped besides quotes inside
> any query method. This package **is not** meant to handle user input, and you should not allow users to query computers
on your network.

#### Raw Queries

Once you've connected to the computer, you can execute queries on it with its connection. To execute a raw query, use:

    $connection = $wmi->getConnection();
    
    $results = $connection->query('SELECT * FROM Win32_LogicalDisk');

    foreach($results as $disk)
    {
        $disk->Size;
    }

#### Query Builder

WMI Comes with a WQL query builder so you're able to easily build statements. To create a new Builder use the `newQuery()`
method on the WMI connection instance like so:

    $query = $wmi->getConnection()->newQuery();
    
Once you have the query, we can start building:

    $results = $query->select('*')
        ->from('Win32_LogicalDisk')
        ->where('Size', '>=', '150000')
        ->get();
    

##### Select

The select method accepts a string or an array to insert selects onto the current query. For example:

    // Select All
    $query->select('*');
    
    // Select Specific
    $query->select(['Name', 'Disk', 'Size']);
    
    // Select Specific (string)
    $query->select('Name, Disk, Size');
    
If you don't use the select method, that's fine too. The Builder will
assume you're meaning to select all columns, so you're able to perform:

    $query->from('Win32_LogicalDisk')->get();
    
    // Query Executed
    SELECT * FROM Win32_LogicalDisk

##### From

The from method accepts a string that is a WMI class name. For example:

    $query->from('Win32_DiskDrive')->get();
    
    // Or
    
    $query->from('Win32_BIOS')->get();

For more information on WMI classes, visit: https://msdn.microsoft.com/en-us/library/aa394132(v=vs.85).aspx

##### Where

The where method accepts a field, operator and value. This is useful for retrieving data with a specific set of requirements.

The method:

    $query->where($field, $operator, $value);

Example:

    $query->where('Size', '>', 15000)->from('Win32_LogicalDisk')->get();

The field parameter needs to be an attribute in the `from` class, otherwise you will not receive the correct results.
