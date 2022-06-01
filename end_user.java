public abstract class end_user
{
    protected String id;
    protected String username;
    protected String password;
    protected String location;
    protected double amount;

    abstract public void sign_up(String id, String username, String password, String location, double amount);
    abstract public void login(String username, String password);
    abstract public String get_username();
    abstract public double get_amount();
}