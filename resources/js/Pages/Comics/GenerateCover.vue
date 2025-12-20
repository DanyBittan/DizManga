<script setup>
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import TextInput from "@/Components/TextInput.vue";
    import InputLabel from "@/Components/InputLabel.vue";
    import { useForm } from "@inertiajs/vue3";
    import { ref } from "vue";
    import axios from 'axios'; 
    import { IconArrowNarrowUpDashed } from '@tabler/icons-vue';

    const prompt = ref('');
    const form = useForm({
        prompt: '',
    });

    const imageUrl = ref(''); 
    const loading = ref(false);
    const savedImages = [];

    // Function to generate image based on prompt
    const generateImage = async () => {
        loading.value = true;
        imageUrl.value = '';

        // Make API call to backend to generate image
        try {
            const response = await axios.get(route('imageGeneration', {
                prompt: form.prompt
            }));
            if (response.data.success) {
                imageUrl.value = response.data.imageUrl;
                savedImages.unshift(response.data.imageUrl);
                console.log('Image URL received:', response.data.imageUrl);
                console.log(savedImages);
            }
        } catch (error) {
            console.error('Error generating image:', error);
        } finally {
            loading.value = false;
        }
    };
</script>

<template>
    <AuthenticatedLayout>
        <!-- Prompt input form -->
        <div class="max-w-7xl mx-auto py-10 relative">
            <form @submit.prevent="generateImage">
                <InputLabel for="image_prompt" value="Write your idea for a comic cover here:" class="text-xl" />
                <TextInput
                    type="text"
                    id="image_prompt"
                    required
                    v-model="form.prompt"
                    :disabled="loading"
                    class="w-full max-h-26 h-16 bg-neutral-900 rounded-2xl shadow-md shadow-blue-900 text-white mt-4 p-4 text-lg break-words"
                    placeholder="Enter a description for your comic cover (e.g., 'A heroic figure standing atop a city skyline at sunset')"
                />
                <button type="submit" :disabled="loading" class="right-4 absolute mt-7 p-2 bg-gray-500 text-white rounded-full hover:bg-neutral-600 transition duration-150">
                    <span v-if="loading">Generating...</span>
                    <span v-else><IconArrowNarrowUpDashed /></span>
                </button>
            </form>
        </div>

        <!-- generated images display -->
        <div class="max-w-7xl w-full mx-auto py-6 bg-neutral-900 rounded-xl flex flex-wrap gap-5 justify-start items-center min-h-[300px] ">
            <div v-if="loading" class="text-white text-xl text-center w-full">
                Generating your image, please wait...
            </div>
            <!-- text to show if we dont have any generated images previously -->
            <div v-else-if="!savedImages[0]" class="text-neutral-400 text-lg text-center w-full">
                Type a prompt above and click 'Generate Cover' to generate an image.
            </div>
            <!-- Display new and previous generated images -->
            <img
            v-else
            v-for="images in savedImages"
            :src="images" 
            alt="Generated comic cover"
            class="max-w-md max-h-1/4  w-96 rounded-lg shadow-lg ml-4"
            />
        </div>
    </AuthenticatedLayout>
</template>