using Microsoft.AspNetCore.Hosting;
using Microsoft.Extensions.Hosting;

namespace AdminApi
{
    public class Program
    {
        public static readonly string ADMIN_URL = "https://styleme.best";
        public static readonly string API_URL = "http://localhost:5000";
        public static readonly string API_DOMAIN = "styleme.best";
        public static void Main(string[] args)
        {
            CreateHostBuilder(args).Build().Run();
        }

        public static IHostBuilder CreateHostBuilder(string[] args) =>
            Host.CreateDefaultBuilder(args)
                .ConfigureWebHostDefaults(webBuilder =>
                {
                    webBuilder.UseStartup<Startup>()
                                .UseUrls(API_URL);
                });
    }
}
