public class Item
{
    private String id;
    private String item_name;
    private double price;
    private int count;

    public Item()
    {
        id = "";
        item_name = "";
        price = 0;
        count = 0;
    }

    public void set_item(String id, String item_name, double price, int count)
    {
        this.id = id;
        this.item_name = item_name;
        this.price = price;
        this.count = count;
    }

    public String get_item_name()
    {
        return this.item_name;
    }

    public double get_price()
    {
        return this.price;
    }

    public int get_count()
    {
        return this.count;
    }
}